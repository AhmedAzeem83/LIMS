@extends("layouts.app")

@section("title", "Chemical Inventory")

@section("content")
<div class="container-fluid">
    <h1 class="h3 mb-2 text-gray-800">Chemical Inventory</h1>
    <p class="mb-4">Manage laboratory chemical stocks.</p>

    @can("manage chemicals")
    <div class="mb-3">
        <a href="{{ route("chemicals.create") }}" class="btn btn-primary">Add New Chemical</a>
    </div>
    @endcan

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Chemical List</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>CAS Number</th>
                            <th>Category</th>
                            <th>Quantity</th>
                            <th>Unit</th>
                            <th>Location</th>
                            <th>Expiry Date</th>
                            <th>Lab</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($chemicals as $chemical)
                            <tr class="{{ $chemical->isExpired() ? "table-danger" : ($chemical->isLowStock() ? "table-warning" : "") }}">
                                <td>{{ $chemical->id }}</td>
                                <td>{{ $chemical->name }}</td>
                                <td>{{ $chemical->cas_number ?? "N/A" }}</td>
                                <td>{{ $chemical->category }}</td>
                                <td>{{ $chemical->quantity }}</td>
                                <td>{{ $chemical->unit }}</td>
                                <td>{{ $chemical->location }}</td>
                                <td>
                                    {{ $chemical->expiry_date ? $chemical->expiry_date->format("Y-m-d") : "N/A" }}
                                    @if($chemical->isExpired())
                                        <span class="badge bg-danger ms-1">Expired</span>
                                    @endif
                                </td>
                                <td>{{ $chemical->lab->name }}</td>
                                <td>
                                    <a href="{{ route("chemicals.show", $chemical) }}" class="btn btn-info btn-sm">View</a>
                                    @can("manage chemicals")
                                    <a href="{{ route("chemicals.edit", $chemical) }}" class="btn btn-warning btn-sm">Edit</a>
                                    <form action="{{ route("chemicals.destroy", $chemical) }}" method="POST" class="d-inline" onsubmit="return confirm("Are you sure you want to delete this chemical?");">
                                        @csrf
                                        @method("DELETE")
                                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                    </form>
                                    @endcan
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="10" class="text-center">No chemicals found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

