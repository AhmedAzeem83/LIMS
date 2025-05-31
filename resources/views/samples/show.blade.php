@extends("layouts.app")

@section("title", "Sample Details: " . $sample->sample_id)

@section("content")
<div class="container-fluid">
    <h1 class="h3 mb-2 text-gray-800">Sample Details: {{ $sample->sample_id }}</h1>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Sample Information</h6>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <p><strong>Sample ID:</strong> {{ $sample->sample_id }}</p>
                    <p><strong>Client Name:</strong> {{ $sample->client_name }}</p>
                    <p><strong>Sample Type:</strong> {{ Str::title(str_replace("_", " ", $sample->sample_type)) }}</p>
                    <p><strong>Received Date:</strong> {{ $sample->received_date->format("Y-m-d") }}</p>
                    <p><strong>Lab:</strong> <a href="{{ route("labs.show", $sample->lab) }}">{{ $sample->lab->name }}</a></p>
                </div>
                <div class="col-md-6">
                    <p><strong>Status:</strong> <span class="{{ $sample->status_badge }}">{{ Str::title(str_replace("_", " ", $sample->status)) }}</span></p>
                    <p><strong>Created By:</strong> <a href="{{ route("users.show", $sample->creator) }}">{{ $sample->creator->name }}</a></p>
                    <p><strong>Created At:</strong> {{ $sample->created_at->format("Y-m-d H:i:s") }}</p>
                    <p><strong>Updated At:</strong> {{ $sample->updated_at->format("Y-m-d H:i:s") }}</p>
                    <p><strong>Notes:</strong> {{ $sample->notes ?? "N/A" }}</p>
                </div>
            </div>
            <hr>
            <a href="{{ route("samples.index") }}" class="btn btn-secondary">Back to List</a>
            @can("manage samples")
            <a href="{{ route("samples.edit", $sample) }}" class="btn btn-warning">Edit Sample</a>
            @endcan
            @can("manage tests")
            <a href="{{ route("tests.create", ["sample_id" => $sample->id]) }}" class="btn btn-success">Add Test</a>
            @endcan
        </div>
    </div>

    <!-- Associated Tests -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Associated Tests</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Test ID</th>
                            <th>Type</th>
                            <th>Method</th>
                            <th>Status</th>
                            <th>Assigned To</th>
                            <th>Completed At</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($sample->tests as $test)
                            <tr>
                                <td>{{ $test->id }}</td>
                                <td>{{ Str::title(str_replace("_", " ", $test->test_type)) }}</td>
                                <td>{{ $test->method }}</td>
                                <td><span class="{{ $test->status_badge }}">{{ Str::title(str_replace("_", " ", $test->status)) }}</span></td>
                                <td>{{ $test->assignedUser?->name ?? "N/A" }}</td>
                                <td>{{ $test->completed_at ? $test->completed_at->format("Y-m-d H:i:s") : "N/A" }}</td>
                                <td>
                                    <a href="{{ route("tests.show", $test) }}" class="btn btn-info btn-sm">View</a>
                                    @can("manage tests")
                                    <a href="{{ route("tests.edit", $test) }}" class="btn btn-warning btn-sm">Edit</a>
                                    @endcan
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center">No tests associated with this sample.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
@endsection

