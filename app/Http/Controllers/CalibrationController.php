<?php

namespace App\Http\Controllers;

use App\Http\Requests\CalibrationRequest;
use App\Models\Calibration;
use App\Models\Device;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class CalibrationController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:view devices')->only(['index', 'show']);
        $this->middleware('permission:calibrate devices')->only(['create', 'store', 'edit', 'update', 'destroy']);
    }

    public function index()
    {
        $calibrations = Calibration::with(['device', 'performer'])->get();
        return view('calibrations.index', compact('calibrations'));
    }

    public function create()
    {
        $devices = Device::all();
        return view('calibrations.create', compact('devices'));
    }

    public function store(CalibrationRequest $request)
    {
        $data = $request->validated();
        $data['performed_by'] = Auth::id();
        
        if ($request->hasFile('certificate')) {
            $path = $request->file('certificate')->store('certificates', 'public');
            $data['certificate'] = $path;
        }
        
        $calibration = Calibration::create($data);
        
        // Update device calibration dates
        $device = Device::findOrFail($data['device_id']);
        $device->update([
            'last_calibration_date' => $data['calibration_date'],
            'next_calibration_date' => $data['next_due_date'],
        ]);
        
        return redirect()->route('calibrations.index')->with('success', 'Calibration record created successfully.');
    }

    public function show(Calibration $calibration)
    {
        $calibration->load(['device', 'performer']);
        return view('calibrations.show', compact('calibration'));
    }

    public function edit(Calibration $calibration)
    {
        $devices = Device::all();
        return view('calibrations.edit', compact('calibration', 'devices'));
    }

    public function update(CalibrationRequest $request, Calibration $calibration)
    {
        $data = $request->validated();
        
        if ($request->hasFile('certificate')) {
            if ($calibration->certificate) {
                Storage::disk('public')->delete($calibration->certificate);
            }
            $path = $request->file('certificate')->store('certificates', 'public');
            $data['certificate'] = $path;
        }
        
        $calibration->update($data);
        
        // Update device calibration dates
        $device = Device::findOrFail($data['device_id']);
        $device->update([
            'last_calibration_date' => $data['calibration_date'],
            'next_calibration_date' => $data['next_due_date'],
        ]);
        
        return redirect()->route('calibrations.index')->with('success', 'Calibration record updated successfully.');
    }

    public function destroy(Calibration $calibration)
    {
        if ($calibration->certificate) {
            Storage::disk('public')->delete($calibration->certificate);
        }
        
        $calibration->delete();
        return redirect()->route('calibrations.index')->with('success', 'Calibration record deleted successfully.');
    }
}
