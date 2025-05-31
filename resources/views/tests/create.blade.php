@extends("layouts.app")

@section("title", "Add New Test")

@section("content")
<div class="container-fluid">
    <h1 class="h3 mb-2 text-gray-800">Add New Test</h1>
    <p class="mb-4">Enter the details for the new laboratory test.</p>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Test Details</h6>
        </div>
        <div class="card-body">
            <form action="{{ route("tests.store") }}" method="POST">
                @csrf
                @include("tests._form")
                <button type="submit" class="btn btn-primary">Create Test</button>
                <a href="{{ route("tests.index") }}" class="btn btn-secondary">Cancel</a>
            </form>
        </div>
    </div>
</div>
@endsection

