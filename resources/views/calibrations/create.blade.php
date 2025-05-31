@extends("layouts.app")

@section("title", "Add Calibration Record")

@section("content")
<div class="container-fluid">
    <h1 class="h3 mb-2 text-gray-800">Add New Calibration Record</h1>
    <p class="mb-4">Enter the details for the new device calibration.</p>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Calibration Details</h6>
        </div>
        <div class="card-body">
            <form action="{{ route("calibrations.store") }}" method="POST" enctype="multipart/form-data">
                @csrf
                @include("calibrations._form")
                <button type="submit" class="btn btn-primary">Create Record</button>
                <a href="{{ route("calibrations.index") }}" class="btn btn-secondary">Cancel</a>
            </form>
        </div>
    </div>
</div>
@endsection

