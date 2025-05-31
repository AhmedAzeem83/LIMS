@extends("layouts.app")

@section("title", "Edit Test")

@section("content")
<div class="container-fluid">
    <h1 class="h3 mb-2 text-gray-800">Edit Test: #{{ $test->id }} for Sample {{ $test->sample->sample_id }}</h1>
    <p class="mb-4">Update the details for this laboratory test.</p>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Test Details</h6>
        </div>
        <div class="card-body">
            <form action="{{ route("tests.update", $test) }}" method="POST">
                @csrf
                @method("PUT")
                @include("tests._form")
                <button type="submit" class="btn btn-primary">Update Test</button>
                <a href="{{ route("tests.index") }}" class="btn btn-secondary">Cancel</a>
            </form>
        </div>
    </div>
</div>
@endsection

