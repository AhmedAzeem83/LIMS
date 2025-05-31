@extends("layouts.app")

@section("title", "Device Details: " . $device->name)

@section("content")
<div class="container-fluid">
    <h1 class="h3 mb-2 text-gray-800">Device Details: {{ $device->name }}</h1>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Device Information</h6>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <p><strong>ID:</strong> {{ $device->id }}</p>
                    <p><strong>Name:</strong> {{ $device->name }}</p>
                    <p><strong>Model:</strong> {{ $device->model }}</p>
                    <p><strong>Serial Number:</strong> {{ $device->serial_number }}</p>
                    <p><strong>Manufacturer:</strong> {{ $device->manufacturer }}</p>
                    <p><strong>Lab:</strong> <a href="{{ route("labs.show", $device->lab) }}">{{ $device->lab->name }}</a></p>
                </div>
                <div class="col-md-6">
                    <p><strong>Purchase Date:</strong> {{ $device->purchase_date->format("Y-m-d") }}</p>
                    <p><strong>Last Calibration:</strong> {{ $device->last_calibration_date ? $device->last_calibration_date->format("Y-m-d") : "N/A" }}</p>
                    <p><strong>Next Calibration:</strong> {{ $device->next_calibration_date ? $device->next_calibration_date->format("Y-m-d") : "N/A" }}</p>
                    <p><strong>Status:</strong> <span class="badge bg-{{ $device->status === "operational" ? "success" : ($device->status === "maintenance" ? "warning" : "danger") }}">{{ Str::title($device->status) }}</span></p>
                    <p><strong>Created At:</strong> {{ $device->created_at->format("Y-m-d H:i:s") }}</p>
                    <p><strong>Updated At:</strong> {{ $device->updated_at->format("Y-m-d H:i:s") }}</p>
                </div>
            </div>
            <hr>
            <a href="{{ route("devices.index") }}" class="btn btn-secondary">Back to List</a>
            @can("manage devices")
            <a href="{{ route("devices.edit", $device) }}" class="btn btn-warning">Edit Device</a>
            @endcan
        </div>
    </div>

    <!-- Calibration History -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Calibration History</h6>
        </div>
        <div class="card-body">
            @can("calibrate devices")
            <div class="mb-3">
                <a href="{{ route("calibrations.create", ["device_id" => $device->id]) }}" class="btn btn-primary btn-sm">Add Calibration Record</a>
            </div>
            @endcan
            <div class="table-responsive">
                <table class="table table-bordered" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Calibration Date</th>
                            <th>Performed By</th>
                            <th>Next Due Date</th>
                            <th>Status</th>
                            <th>Certificate</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($device->calibrations as $calibration)
                            <tr>
                                <td>{{ $calibration->calibration_date->format("Y-m-d") }}</td>
                                <td>{{ $calibration->performer->name }}</td>
                                <td>{{ $calibration->next_due_date->format("Y-m-d") }}</td>
                                <td><span class="badge bg-{{ $calibration->status === "passed" ? "success" : ($calibration->status === "failed" ? "danger" : "warning") }}">{{ Str::title($calibration->status) }}</span></td>
                                <td>
                                    @if($calibration->certificate)
                                        <a href="{{ Storage::url($calibration->certificate) }}" target="_blank">View Certificate</a>
                                    @else
                                        N/A
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route("calibrations.show", $calibration) }}" class="btn btn-info btn-sm">View</a>
                                    @can("calibrate devices")
                                    <a href="{{ route("calibrations.edit", $calibration) }}" class="btn btn-warning btn-sm">Edit</a>
                                    @endcan
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center">No calibration records found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
@endsection

