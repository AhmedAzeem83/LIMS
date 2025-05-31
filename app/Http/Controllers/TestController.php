<?php

namespace App\Http\Controllers;

use App\Http\Requests\TestRequest;
use App\Models\Device;
use App\Models\Lab;
use App\Models\Sample;
use App\Models\Test;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TestController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:view tests')->only(['index', 'show']);
        $this->middleware('permission:manage tests')->only(['create', 'store', 'edit', 'update', 'destroy']);
        $this->middleware('permission:perform tests')->only(['startTest', 'completeTest']);
        $this->middleware('permission:approve tests')->only(['approveTest', 'rejectTest']);
    }

    public function index()
    {
        $tests = Test::with(['sample', 'device', 'assignedUser', 'approver'])->get();
        return view('tests.index', compact('tests'));
    }

    public function create()
    {
        $samples = Sample::all();
        $devices = Device::where('status', 'operational')->get();
        $technicians = User::role('Lab Technician')->get();
        $labs = Lab::all();
        
        return view('tests.create', compact('samples', 'devices', 'technicians', 'labs'));
    }

    public function store(TestRequest $request)
    {
        $data = $request->validated();
        $sample = Sample::findOrFail($data['sample_id']);
        $data['lab_id'] = $sample->lab_id;
        
        $test = Test::create($data);
        
        // Update sample status if it's the first test
        if ($sample->status === 'pending') {
            $sample->update(['status' => 'in_progress']);
        }
        
        return redirect()->route('tests.index')->with('success', 'Test created successfully.');
    }

    public function show(Test $test)
    {
        $test->load(['sample', 'device', 'assignedUser', 'approver', 'reports']);
        return view('tests.show', compact('test'));
    }

    public function edit(Test $test)
    {
        $samples = Sample::all();
        $devices = Device::where('status', 'operational')->get();
        $technicians = User::role('Lab Technician')->get();
        $labs = Lab::all();
        
        return view('tests.edit', compact('test', 'samples', 'devices', 'technicians', 'labs'));
    }

    public function update(TestRequest $request, Test $test)
    {
        $test->update($request->validated());
        return redirect()->route('tests.index')->with('success', 'Test updated successfully.');
    }

    public function destroy(Test $test)
    {
        $test->delete();
        return redirect()->route('tests.index')->with('success', 'Test deleted successfully.');
    }

    public function startTest(Test $test)
    {
        if ($test->status !== 'pending') {
            return redirect()->back()->with('error', 'Test cannot be started.');
        }
        
        $test->update([
            'status' => 'in_progress',
            'started_at' => now(),
        ]);
        
        return redirect()->route('tests.show', $test)->with('success', 'Test started successfully.');
    }

    public function completeTest(Request $request, Test $test)
    {
        if ($test->status !== 'in_progress') {
            return redirect()->back()->with('error', 'Test cannot be completed.');
        }
        
        $validated = $request->validate([
            'results' => 'required|array',
            'notes' => 'nullable|string',
        ]);
        
        $test->update([
            'status' => 'completed',
            'completed_at' => now(),
            'results' => $validated['results'],
            'notes' => $validated['notes'],
        ]);
        
        return redirect()->route('tests.show', $test)->with('success', 'Test completed successfully.');
    }

    public function approveTest(Test $test)
    {
        if ($test->status !== 'completed') {
            return redirect()->back()->with('error', 'Test cannot be approved.');
        }
        
        $test->update([
            'status' => 'approved',
            'approved_by' => Auth::id(),
        ]);
        
        // Check if all tests for this sample are approved
        $sample = $test->sample;
        $pendingTests = $sample->tests()->whereNotIn('status', ['approved', 'rejected'])->count();
        
        if ($pendingTests === 0) {
            $sample->update(['status' => 'completed']);
        }
        
        return redirect()->route('tests.show', $test)->with('success', 'Test approved successfully.');
    }

    public function rejectTest(Request $request, Test $test)
    {
        if ($test->status !== 'completed') {
            return redirect()->back()->with('error', 'Test cannot be rejected.');
        }
        
        $validated = $request->validate([
            'rejection_reason' => 'required|string',
        ]);
        
        $test->update([
            'status' => 'rejected',
            'notes' => ($test->notes ? $test->notes . "\n\n" : '') . "Rejection reason: " . $validated['rejection_reason'],
        ]);
        
        return redirect()->route('tests.show', $test)->with('success', 'Test rejected successfully.');
    }
}
