@extends("layouts.app")

@section("title", "Edit Device")

@section("content")
<div class="container-fluid">
    <h1 class="h3 mb-2 text-gray-800">Edit Device: {{ $device->name }}</h1>
    <p class="mb-4">Update the details for this laboratory device.</p>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Device Details</h6>
        </div>
        <div class="card-body">
            <form action="{{ route("devices.update", $device) }}" method="POST">
                @csrf
                @method("PUT")
                @include("devices._form")
                <button type="submit" class="btn btn-primary">Update Device</button>
                <a href="{{ route("devices.index") }}" class="btn btn-secondary">Cancel</a>
            </form>
        </div>
    </div>
</div>
@endsection

