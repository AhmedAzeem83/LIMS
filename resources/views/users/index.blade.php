@extends("layouts.app")

@section("title", "Users")

@section("content")
<div class="container-fluid">
    <h1 class="h3 mb-2 text-gray-800">Users</h1>
    <p class="mb-4">Manage system users and their roles.</p>

    @can("manage users")
    <div class="mb-3">
        <a href="{{ route("users.create") }}" class="btn btn-primary">Add New User</a>
    </div>
    @endcan

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">User List</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Lab</th>
                            <th>Created At</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($users as $user)
                            <tr>
                                <td>{{ $user->id }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->roles->pluck("name")->implode(", ") }}</td>
                                <td>{{ $user->lab?->name ?? "N/A" }}</td>
                                <td>{{ $user->created_at->format("Y-m-d H:i:s") }}</td>
                                <td>
                                    <a href="{{ route("users.show", $user) }}" class="btn btn-info btn-sm">View</a>
                                    @can("manage users")
                                    <a href="{{ route("users.edit", $user) }}" class="btn btn-warning btn-sm">Edit</a>
                                    <form action="{{ route("users.destroy", $user) }}" method="POST" class="d-inline" onsubmit="return confirm("Are you sure you want to delete this user?");">
                                        @csrf
                                        @method("DELETE")
                                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                    </form>
                                    @endcan
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center">No users found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

