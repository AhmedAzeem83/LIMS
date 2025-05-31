@extends("layouts.app")

@section("title", "Calibrations")

@section("content")
<div class="container-fluid">
    <h1 class="h3 mb-2 text-gray-800">Calibrations</h1>
    <p class="mb-4">Manage device calibration records.</p>

    @can("calibrate devices")
    <div class="mb-3">
        <a href="{{ route("calibrations.create") }}" class="btn btn-primary">Add New Calibration Record</a>
    </div>
    @endcan

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Calibration List</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Device</th>
                            <th>Calibration Date</th>
                            <th>Next Due Date</th>
                            <th>Status</th>
                            <th>Performed By</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($calibrations as $calibration)
                            <tr class="{{ $calibration->isDueSoon() ? "table-warning" : ($calibration->isOverdue() ? "table-danger" : "") }}">
                                <td>{{ $calibration->id }}</td>
                                <td><a href="{{ route("devices.show", $calibration->device) }}">{{ $calibration->device->name }} ({{ $calibration->device->serial_number }})</a></td>
                                <td>{{ $calibration->calibration_date->format("Y-m-d") }}</td>
                                <td>
                                    {{ $calibration->next_due_date->format("Y-m-d") }}
                                    @if($calibration->isOverdue())
                                        <span class="badge bg-danger ms-1">Overdue</span>
                                    @elseif($calibration->isDueSoon())
                                        <span class="badge bg-warning ms-1">Due Soon</span>
                                    @endif
                                </td>
                                <td><span class="badge bg-{{ $calibration->status === "passed" ? "success" : ($calibration->status === "failed" ? "danger" : "warning") }}">{{ Str::title($calibration->status) }}</span></td>
                                <td>{{ $calibration->performer->name }}</td>
                                <td>
                                    <a href="{{ route("calibrations.show", $calibration) }}" class="btn btn-info btn-sm">View</a>
                                    @can("calibrate devices")
                                    <a href="{{ route("calibrations.edit", $calibration) }}" class="btn btn-warning btn-sm">Edit</a>
                                    <form action="{{ route("calibrations.destroy", $calibration) }}" method="POST" class="d-inline" onsubmit="return confirm("Are you sure you want to delete this calibration record?");">
                                        @csrf
                                        @method("DELETE")
                                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                    </form>
                                    @endcan
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center">No calibration records found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

