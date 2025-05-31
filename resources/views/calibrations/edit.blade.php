@extends("layouts.app")

@section("title", "Edit Calibration Record")

@section("content")
<div class="container-fluid">
    <h1 class="h3 mb-2 text-gray-800">Edit Calibration Record #{{ $calibration->id }}</h1>
    <p class="mb-4">Update the details for this device calibration.</p>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Calibration Details</h6>
        </div>
        <div class="card-body">
            <form action="{{ route("calibrations.update", $calibration) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method("PUT")
                @include("calibrations._form")
                <button type="submit" class="btn btn-primary">Update Record</button>
                <a href="{{ route("calibrations.index") }}" class="btn btn-secondary">Cancel</a>
            </form>
        </div>
    </div>
</div>
@endsection

