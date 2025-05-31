<?php

namespace App\Http\Controllers;

use App\Http\Requests\SampleRequest;
use App\Models\Lab;
use App\Models\Sample;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class SampleController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:view samples')->only(['index', 'show']);
        $this->middleware('permission:manage samples')->only(['create', 'store', 'edit', 'update', 'destroy']);
    }

    public function index()
    {
        $samples = Sample::with(['lab', 'creator'])->get();
        return view('samples.index', compact('samples'));
    }

    public function create()
    {
        $labs = Lab::all();
        return view('samples.create', compact('labs'));
    }

    public function store(SampleRequest $request)
    {
        $data = $request->validated();
        $data['created_by'] = Auth::id();
        $data['sample_id'] = 'S-' . date('Ymd') . '-' . Str::random(5);
        
        $sample = Sample::create($data);
        return redirect()->route('samples.index')->with('success', 'Sample created successfully.');
    }

    public function show(Sample $sample)
    {
        $sample->load(['lab', 'creator', 'tests']);
        return view('samples.show', compact('sample'));
    }

    public function edit(Sample $sample)
    {
        $labs = Lab::all();
        return view('samples.edit', compact('sample', 'labs'));
    }

    public function update(SampleRequest $request, Sample $sample)
    {
        $sample->update($request->validated());
        return redirect()->route('samples.index')->with('success', 'Sample updated successfully.');
    }

    public function destroy(Sample $sample)
    {
        $sample->delete();
        return redirect()->route('samples.index')->with('success', 'Sample deleted successfully.');
    }
}
