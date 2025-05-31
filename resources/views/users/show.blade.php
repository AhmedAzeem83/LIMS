@extends("layouts.app")

@section("title", "User Details: " . $user->name)

@section("content")
<div class="container-fluid">
    <h1 class="h3 mb-2 text-gray-800">User Details: {{ $user->name }}</h1>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">User Information</h6>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <p><strong>ID:</strong> {{ $user->id }}</p>
                    <p><strong>Name:</strong> {{ $user->name }}</p>
                    <p><strong>Email:</strong> {{ $user->email }}</p>
                    <p><strong>Role(s):</strong> {{ $user->roles->pluck("name")->implode(", ") }}</p>
                </div>
                <div class="col-md-6">
                    <p><strong>Lab:</strong> {{ $user->lab?->name ?? "N/A" }}</p>
                    <p><strong>Email Verified At:</strong> {{ $user->email_verified_at ? $user->email_verified_at->format("Y-m-d H:i:s") : "Not Verified" }}</p>
                    <p><strong>Created At:</strong> {{ $user->created_at->format("Y-m-d H:i:s") }}</p>
                    <p><strong>Updated At:</strong> {{ $user->updated_at->format("Y-m-d H:i:s") }}</p>
                </div>
            </div>
            <hr>
            <a href="{{ route("users.index") }}" class="btn btn-secondary">Back to List</a>
            @can("manage users")
            <a href="{{ route("users.edit", $user) }}" class="btn btn-warning">Edit User</a>
            @endcan
        </div>
    </div>
</div>
@endsection

