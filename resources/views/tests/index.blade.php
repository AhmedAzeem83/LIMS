@extends("layouts.app")

@section("title", "Tests")

@section("content")
<div class="container-fluid">
    <h1 class="h3 mb-2 text-gray-800">Tests</h1>
    <p class="mb-4">Manage laboratory tests and results.</p>

    @can("manage tests")
    <div class="mb-3">
        <a href="{{ route("tests.create") }}" class="btn btn-primary">Add New Test</a>
    </div>
    @endcan

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Test List</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Test ID</th>
                            <th>Sample ID</th>
                            <th>Test Type</th>
                            <th>Method</th>
                            <th>Status</th>
                            <th>Assigned To</th>
                            <th>Lab</th>
                            <th>Completed At</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($tests as $test)
                            <tr>
                                <td>{{ $test->id }}</td>
                                <td><a href="{{ route("samples.show", $test->sample) }}">{{ $test->sample->sample_id }}</a></td>
                                <td>{{ Str::title(str_replace("_", " ", $test->test_type)) }}</td>
                                <td>{{ $test->method }}</td>
                                <td><span class="{{ $test->status_badge }}">{{ Str::title(str_replace("_", " ", $test->status)) }}</span></td>
                                <td>{{ $test->assignedUser?->name ?? "N/A" }}</td>
                                <td>{{ $test->sample->lab->name }}</td>
                                <td>{{ $test->completed_at ? $test->completed_at->format("Y-m-d H:i:s") : "N/A" }}</td>
                                <td>
                                    <a href="{{ route("tests.show", $test) }}" class="btn btn-info btn-sm">View</a>
                                    @can("manage tests")
                                    <a href="{{ route("tests.edit", $test) }}" class="btn btn-warning btn-sm">Edit</a>
                                    <form action="{{ route("tests.destroy", $test) }}" method="POST" class="d-inline" onsubmit="return confirm("Are you sure you want to delete this test?");">
                                        @csrf
                                        @method("DELETE")
                                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                    </form>
                                    @endcan
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="9" class="text-center">No tests found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

