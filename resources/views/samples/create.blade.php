@extends("layouts.app")

@section("title", "Add New Sample")

@section("content")
<div class="container-fluid">
    <h1 class="h3 mb-2 text-gray-800">Add New Sample</h1>
    <p class="mb-4">Enter the details for the new laboratory sample.</p>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Sample Details</h6>
        </div>
        <div class="card-body">
            <form action="{{ route("samples.store") }}" method="POST">
                @csrf
                @include("samples._form")
                <button type="submit" class="btn btn-primary">Create Sample</button>
                <a href="{{ route("samples.index") }}" class="btn btn-secondary">Cancel</a>
            </form>
        </div>
    </div>
</div>
@endsection

