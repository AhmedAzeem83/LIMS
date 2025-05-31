@extends("layouts.app")

@section("title", "Calibration Details: #" . $calibration->id)

@section("content")
<div class="container-fluid">
    <h1 class="h3 mb-2 text-gray-800">Calibration Details: #{{ $calibration->id }} for Device <a href="{{ route("devices.show", $calibration->device) }}">{{ $calibration->device->name }}</a></h1>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Calibration Information</h6>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <p><strong>Calibration ID:</strong> {{ $calibration->id }}</p>
                    <p><strong>Device:</strong> <a href="{{ route("devices.show", $calibration->device) }}">{{ $calibration->device->name }} ({{ $calibration->device->serial_number }})</a></p>
                    <p><strong>Calibration Date:</strong> {{ $calibration->calibration_date->format("Y-m-d") }}</p>
                    <p><strong>Next Due Date:</strong> 
                        {{ $calibration->next_due_date->format("Y-m-d") }}
                        @if($calibration->isOverdue())
                            <span class="badge bg-danger ms-1">Overdue</span>
                        @elseif($calibration->isDueSoon())
                            <span class="badge bg-warning ms-1">Due Soon</span>
                        @endif
                    </p>
                </div>
                <div class="col-md-6">
                    <p><strong>Status:</strong> <span class="badge bg-{{ $calibration->status === "passed" ? "success" : ($calibration->status === "failed" ? "danger" : "warning") }}">{{ Str::title($calibration->status) }}</span></p>
                    <p><strong>Performed By:</strong> <a href="{{ route("users.show", $calibration->performer) }}">{{ $calibration->performer->name }}</a></p>
                    <p><strong>Certificate:</strong> 
                        @if($calibration->certificate)
                            <a href="{{ Storage::url($calibration->certificate) }}" target="_blank">View Certificate</a>
                        @else
                            N/A
                        @endif
                    </p>
                    <p><strong>Created At:</strong> {{ $calibration->created_at->format("Y-m-d H:i:s") }}</p>
                    <p><strong>Updated At:</strong> {{ $calibration->updated_at->format("Y-m-d H:i:s") }}</p>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-md-12">
                    <p><strong>Notes:</strong> {{ $calibration->notes ?? "N/A" }}</p>
                </div>
            </div>
            <hr>
            <a href="{{ route("calibrations.index") }}" class="btn btn-secondary">Back to List</a>
            @can("calibrate devices")
            <a href="{{ route("calibrations.edit", $calibration) }}" class="btn btn-warning">Edit Record</a>
            @endcan
        </div>
    </div>
</div>
@endsection

