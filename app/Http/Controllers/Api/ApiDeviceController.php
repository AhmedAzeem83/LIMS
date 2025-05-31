<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Device;
use Illuminate\Http\Request;

class ApiDeviceController extends Controller
{
    public function index()
    {
        $devices = Device::with('lab')->get();
        return response()->json($devices);
    }

    public function show($id)
    {
        $device = Device::with(['lab', 'calibrations'])->findOrFail($id);
        return response()->json($device);
    }

    public function calibrationStatus($id)
    {
        $device = Device::findOrFail($id);
        
        return response()->json([
            'device' => $device->only(['id', 'name', 'model', 'serial_number']),
            'last_calibration_date' => $device->last_calibration_date,
            'next_calibration_date' => $device->next_calibration_date,
            'needs_calibration' => $device->needsCalibration(),
            'days_until_calibration' => $device->next_calibration_date ? now()->diffInDays($device->next_calibration_date, false) : null,
        ]);
    }
}
