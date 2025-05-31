@extends("layouts.app")

@section("title", "Labs")

@section("content")
<div class="container-fluid">
    <h1 class="h3 mb-2 text-gray-800">Labs</h1>
    <p class="mb-4">Manage laboratory information.</p>

    @can("manage labs")
    <div class="mb-3">
        <a href="{{ route("labs.create") }}" class="btn btn-primary">Add New Lab</a>
    </div>
    @endcan

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Lab List</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Location</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($labs as $lab)
                            <tr>
                                <td>{{ $lab->id }}</td>
                                <td>{{ $lab->name }}</td>
                                <td>{{ $lab->location }}</td>
                                <td><span class="badge bg-{{ $lab->status === "active" ? "success" : ($lab->status === "inactive" ? "secondary" : "warning") }}">{{ Str::title($lab->status) }}</span></td>
                                <td>
                                    <a href="{{ route("labs.show", $lab) }}" class="btn btn-info btn-sm">View</a>
                                    @can("manage labs")
                                    <a href="{{ route("labs.edit", $lab) }}" class="btn btn-warning btn-sm">Edit</a>
                                    <form action="{{ route("labs.destroy", $lab) }}" method="POST" class="d-inline" onsubmit="return confirm("Are you sure you want to delete this lab?");">
                                        @csrf
                                        @method("DELETE")
                                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                    </form>
                                    @endcan
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center">No labs found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

