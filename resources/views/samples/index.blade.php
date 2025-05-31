@extends("layouts.app")

@section("title", "Samples")

@section("content")
<div class="container-fluid">
    <h1 class="h3 mb-2 text-gray-800">Samples</h1>
    <p class="mb-4">Manage laboratory samples.</p>

    @can("manage samples")
    <div class="mb-3">
        <a href="{{ route("samples.create") }}" class="btn btn-primary">Add New Sample</a>
    </div>
    @endcan

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Sample List</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Sample ID</th>
                            <th>Client Name</th>
                            <th>Sample Type</th>
                            <th>Received Date</th>
                            <th>Lab</th>
                            <th>Status</th>
                            <th>Created By</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($samples as $sample)
                            <tr>
                                <td>{{ $sample->sample_id }}</td>
                                <td>{{ $sample->client_name }}</td>
                                <td>{{ Str::title(str_replace("_", " ", $sample->sample_type)) }}</td>
                                <td>{{ $sample->received_date->format("Y-m-d") }}</td>
                                <td>{{ $sample->lab->name }}</td>
                                <td><span class="{{ $sample->status_badge }}">{{ Str::title(str_replace("_", " ", $sample->status)) }}</span></td>
                                <td>{{ $sample->creator->name }}</td>
                                <td>
                                    <a href="{{ route("samples.show", $sample) }}" class="btn btn-info btn-sm">View</a>
                                    @can("manage samples")
                                    <a href="{{ route("samples.edit", $sample) }}" class="btn btn-warning btn-sm">Edit</a>
                                    <form action="{{ route("samples.destroy", $sample) }}" method="POST" class="d-inline" onsubmit="return confirm("Are you sure you want to delete this sample?");">
                                        @csrf
                                        @method("DELETE")
                                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                    </form>
                                    @endcan
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center">No samples found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

