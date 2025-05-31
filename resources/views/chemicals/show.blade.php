@extends("layouts.app")

@section("title", "Chemical Details: " . $chemical->name)

@section("content")
<div class="container-fluid">
    <h1 class="h3 mb-2 text-gray-800">Chemical Details: {{ $chemical->name }}</h1>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Chemical Information</h6>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <p><strong>ID:</strong> {{ $chemical->id }}</p>
                    <p><strong>Name:</strong> {{ $chemical->name }}</p>
                    <p><strong>CAS Number:</strong> {{ $chemical->cas_number ?? "N/A" }}</p>
                    <p><strong>Category:</strong> {{ $chemical->category }}</p>
                    <p><strong>Quantity:</strong> {{ $chemical->quantity }} {{ $chemical->unit }}</p>
                    <p><strong>Location:</strong> {{ $chemical->location }}</p>
                    <p><strong>Lab:</strong> <a href="{{ route("labs.show", $chemical->lab) }}">{{ $chemical->lab->name }}</a></p>
                </div>
                <div class="col-md-6">
                    <p><strong>Expiry Date:</strong> 
                        {{ $chemical->expiry_date ? $chemical->expiry_date->format("Y-m-d") : "N/A" }}
                        @if($chemical->isExpired())
                            <span class="badge bg-danger ms-1">Expired</span>
                        @endif
                    </p>
                    <p><strong>MSDS:</strong> 
                        @if($chemical->msds_file)
                            <a href="{{ Storage::url($chemical->msds_file) }}" target="_blank">View MSDS</a>
                        @else
                            N/A
                        @endif
                    </p>
                    <p><strong>Created At:</strong> {{ $chemical->created_at->format("Y-m-d H:i:s") }}</p>
                    <p><strong>Updated At:</strong> {{ $chemical->updated_at->format("Y-m-d H:i:s") }}</p>
                </div>
            </div>
            <hr>
            <a href="{{ route("chemicals.index") }}" class="btn btn-secondary">Back to List</a>
            @can("manage chemicals")
            <a href="{{ route("chemicals.edit", $chemical) }}" class="btn btn-warning">Edit Chemical</a>
            @endcan
        </div>
    </div>
</div>
@endsection

