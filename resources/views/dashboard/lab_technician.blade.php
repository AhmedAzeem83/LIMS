@extends("layouts.app")

@section("title", "Lab Technician Dashboard")

@section("content")
<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800">Lab Technician Dashboard - {{ $lab->name }}</h1>

    <div class="row">
        <!-- Assigned Tests -->
        <div class="col-xl-6 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Assigned Tests (Pending/In Progress)</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $assignedTests }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="bi bi-list-task fs-2 text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Completed Tests -->
        <div class="col-xl-6 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Completed Tests (by You)</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $completedTests }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="bi bi-check2-circle fs-2 text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Recently Assigned Tests -->
    <div class="row">
        <div class="col-lg-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Recently Assigned Tests</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Test ID</th>
                                    <th>Sample ID</th>
                                    <th>Type</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($recentAssignedTests as $test)
                                    <tr>
                                        <td><a href="{{ route("tests.show", $test) }}">{{ $test->id }}</a></td>
                                        <td><a href="{{ route("samples.show", $test->sample) }}">{{ $test->sample->sample_id }}</a></td>
                                        <td>{{ Str::title(str_replace("_", " ", $test->test_type)) }}</td>
                                        <td><span class="{{ $test->status_badge }}">{{ Str::title(str_replace("_", " ", $test->status)) }}</span></td>
                                        <td>
                                            <a href="{{ route("tests.show", $test) }}" class="btn btn-info btn-sm">View</a>
                                            @if($test->status === "pending")
                                                <form action="{{ route("tests.start", $test) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    <button type="submit" class="btn btn-primary btn-sm">Start Test</button>
                                                </form>
                                            @elseif($test->status === "in_progress")
                                                <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#completeModal{{ $test->id }}">
                                                    Complete Test
                                                </button>
                                                <!-- Complete Modal -->
                                                <div class="modal fade" id="completeModal{{ $test->id }}" tabindex="-1" aria-labelledby="completeModalLabel{{ $test->id }}" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <form action="{{ route("tests.complete", $test) }}" method="POST">
                                                                @csrf
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="completeModalLabel{{ $test->id }}">Complete Test #{{ $test->id }}</h5>
                                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <div class="mb-3">
                                                                        <label for="results{{ $test->id }}" class="form-label">Results (JSON format)</label>
                                                                        <textarea class="form-control" id="results{{ $test->id }}" name="results" rows="5" required>{{ old("results") }}</textarea>
                                                                        <small class="form-text text-muted">Enter results as key-value pairs, e.g., {"density": 0.85, "unit": "g/cm3"}</small>
                                                                    </div>
                                                                    <div class="mb-3">
                                                                        <label for="notes{{ $test->id }}" class="form-label">Notes (Optional)</label>
                                                                        <textarea class="form-control" id="notes{{ $test->id }}" name="notes" rows="3">{{ old("notes") }}</textarea>
                                                                    </div>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                                    <button type="submit" class="btn btn-success">Complete Test</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center">No recently assigned tests found.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection

