@extends("layouts.app")

@section("title", "Edit Lab")

@section("content")
<div class="container-fluid">
    <h1 class="h3 mb-2 text-gray-800">Edit Lab: {{ $lab->name }}</h1>
    <p class="mb-4">Update the details for this laboratory.</p>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Lab Details</h6>
        </div>
        <div class="card-body">
            <form action="{{ route("labs.update", $lab) }}" method="POST">
                @csrf
                @method("PUT")
                @include("labs._form")
                <button type="submit" class="btn btn-primary">Update Lab</button>
                <a href="{{ route("labs.index") }}" class="btn btn-secondary">Cancel</a>
            </form>
        </div>
    </div>
</div>
@endsection

