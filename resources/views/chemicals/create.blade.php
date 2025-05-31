@extends("layouts.app")

@section("title", "Add New Chemical")

@section("content")
<div class="container-fluid">
    <h1 class="h3 mb-2 text-gray-800">Add New Chemical</h1>
    <p class="mb-4">Enter the details for the new chemical.</p>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Chemical Details</h6>
        </div>
        <div class="card-body">
            <form action="{{ route("chemicals.store") }}" method="POST" enctype="multipart/form-data">
                @csrf
                @include("chemicals._form")
                <button type="submit" class="btn btn-primary">Create Chemical</button>
                <a href="{{ route("chemicals.index") }}" class="btn btn-secondary">Cancel</a>
            </form>
        </div>
    </div>
</div>
@endsection

