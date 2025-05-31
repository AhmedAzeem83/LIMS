@extends("layouts.app")

@section("title", "Edit Sample")

@section("content")
<div class="container-fluid">
    <h1 class="h3 mb-2 text-gray-800">Edit Sample: {{ $sample->sample_id }}</h1>
    <p class="mb-4">Update the details for this laboratory sample.</p>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Sample Details</h6>
        </div>
        <div class="card-body">
            <form action="{{ route("samples.update", $sample) }}" method="POST">
                @csrf
                @method("PUT")
                @include("samples._form")
                <button type="submit" class="btn btn-primary">Update Sample</button>
                <a href="{{ route("samples.index") }}" class="btn btn-secondary">Cancel</a>
            </form>
        </div>
    </div>
</div>
@endsection

