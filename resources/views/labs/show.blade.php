@extends("layouts.app")

@section("title", "Lab Details: " . $lab->name)

@section("content")
<div class="container-fluid">
    <h1 class="h3 mb-2 text-gray-800">Lab Details: {{ $lab->name }}</h1>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Lab Information</h6>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <p><strong>ID:</strong> {{ $lab->id }}</p>
                    <p><strong>Name:</strong> {{ $lab->name }}</p>
                    <p><strong>Location:</strong> {{ $lab->location }}</p>
                    <p><strong>Status:</strong> <span class="badge bg-{{ $lab->status === "active" ? "success" : ($lab->status === "inactive" ? "secondary" : "warning") }}">{{ Str::title($lab->status) }}</span></p>
                    <p><strong>Description:</strong> {{ $lab->description ?? "N/A" }}</p>
                    <p><strong>Created At:</strong> {{ $lab->created_at->format("Y-m-d H:i:s") }}</p>
                    <p><strong>Updated At:</strong> {{ $lab->updated_at->format("Y-m-d H:i:s") }}</p>
                </div>
            </div>
            <hr>
            <a href="{{ route("labs.index") }}" class="btn btn-secondary">Back to List</a>
            @can("manage labs")
            <a href="{{ route("labs.edit", $lab) }}" class="btn btn-warning">Edit Lab</a>
            @endcan
        </div>
    </div>

    <!-- Related Information (Optional) -->
    <div class="row">
        <div class="col-lg-6">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Users in this Lab</h6>
                </div>
                <div class="card-body">
                    <ul>
                        @forelse($lab->users as $user)
                            <li><a href="{{ route("users.show", $user) }}">{{ $user->name }}</a> ({{ $user->roles->first()->name }})</li>
                        @empty
                            <li>No users assigned to this lab.</li>
                        @endforelse
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Devices in this Lab</h6>
                </div>
                <div class="card-body">
                    <ul>
                        @forelse($lab->devices as $device)
                            <li><a href="{{ route("devices.show", $device) }}">{{ $device->name }} ({{ $device->serial_number }})</a></li>
                        @empty
                            <li>No devices assigned to this lab.</li>
                        @endforelse
                    </ul>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection

