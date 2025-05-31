<?php

namespace App\Http\Controllers;

use App\Http\Requests\DeviceRequest;
use App\Models\Device;
use App\Models\Lab;
use Illuminate\Http\Request;

class DeviceController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:view devices')->only(['index', 'show']);
        $this->middleware('permission:manage devices')->only(['create', 'store', 'edit', 'update', 'destroy']);
    }

    public function index()
    {
        $devices = Device::with('lab')->get();
        return view('devices.index', compact('devices'));
    }

    public function create()
    {
        $labs = Lab::all();
        return view('devices.create', compact('labs'));
    }

    public function store(DeviceRequest $request)
    {
        $device = Device::create($request->validated());
        return redirect()->route('devices.index')->with('success', 'Device created successfully.');
    }

    public function show(Device $device)
    {
        $device->load(['lab', 'calibrations']);
        return view('devices.show', compact('device'));
    }

    public function edit(Device $device)
    {
        $labs = Lab::all();
        return view('devices.edit', compact('device', 'labs'));
    }

    public function update(DeviceRequest $request, Device $device)
    {
        $device->update($request->validated());
        return redirect()->route('devices.index')->with('success', 'Device updated successfully.');
    }

    public function destroy(Device $device)
    {
        $device->delete();
        return redirect()->route('devices.index')->with('success', 'Device deleted successfully.');
    }
}
