@extends("layouts.app")

@section("title", "Devices")

@section("content")
<div class="container-fluid">
    <h1 class="h3 mb-2 text-gray-800">Devices</h1>
    <p class="mb-4">Manage laboratory devices and equipment.</p>

    @can("manage devices")
    <div class="mb-3">
        <a href="{{ route("devices.create") }}" class="btn btn-primary">Add New Device</a>
    </div>
    @endcan

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Device List</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Model</th>
                            <th>Serial Number</th>
                            <th>Lab</th>
                            <th>Status</th>
                            <th>Next Calibration</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($devices as $device)
                            <tr>
                                <td>{{ $device->id }}</td>
                                <td>{{ $device->name }}</td>
                                <td>{{ $device->model }}</td>
                                <td>{{ $device->serial_number }}</td>
                                <td>{{ $device->lab->name }}</td>
                                <td><span class="badge bg-{{ $device->status === "operational" ? "success" : ($device->status === "maintenance" ? "warning" : "danger") }}">{{ Str::title($device->status) }}</span></td>
                                <td>{{ $device->next_calibration_date ? $device->next_calibration_date->format("Y-m-d") : "N/A" }}</td>
                                <td>
                                    <a href="{{ route("devices.show", $device) }}" class="btn btn-info btn-sm">View</a>
                                    @can("manage devices")
                                    <a href="{{ route("devices.edit", $device) }}" class="btn btn-warning btn-sm">Edit</a>
                                    <form action="{{ route("devices.destroy", $device) }}" method="POST" class="d-inline" onsubmit="return confirm("Are you sure you want to delete this device?");">
                                        @csrf
                                        @method("DELETE")
                                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                    </form>
                                    @endcan
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center">No devices found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

