@extends("layouts.app")

@section("title", "Chemist Supervisor Dashboard")

@section("content")
<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800">Chemist Supervisor Dashboard - {{ $lab->name }}</h1>

    <div class="row">
        <!-- Pending Tests -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                Pending Tests</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $pendingTests }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="bi bi-hourglass-split fs-2 text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- In Progress Tests -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                In Progress Tests</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $inProgressTests }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="bi bi-arrow-repeat fs-2 text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Completed Tests -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Completed Tests</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $completedTests }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="bi bi-check2-circle fs-2 text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tests Needing Approval -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Tests Needing Approval</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $testsNeedingApproval }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="bi bi-clipboard-check fs-2 text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Tests -->
    <div class="row">
        <div class="col-lg-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Recent Tests</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Test ID</th>
                                    <th>Sample ID</th>
                                    <th>Type</th>
                                    <th>Assigned To</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($recentTests as $test)
                                    <tr>
                                        <td><a href="{{ route("tests.show", $test) }}">{{ $test->id }}</a></td>
                                        <td><a href="{{ route("samples.show", $test->sample) }}">{{ $test->sample->sample_id }}</a></td>
                                        <td>{{ Str::title(str_replace("_", " ", $test->test_type)) }}</td>
                                        <td>{{ $test->assignedUser?->name ?? "N/A" }}</td>
                                        <td><span class="{{ $test->status_badge }}">{{ Str::title(str_replace("_", " ", $test->status)) }}</span></td>
                                        <td>
                                            <a href="{{ route("tests.show", $test) }}" class="btn btn-info btn-sm">View</a>
                                            @if($test->status === "completed" && !$test->approved_by)
                                                <form action="{{ route("tests.approve", $test) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    <button type="submit" class="btn btn-success btn-sm">Approve</button>
                                                </form>
                                                <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#rejectModal{{ $test->id }}">
                                                    Reject
                                                </button>
                                                <!-- Reject Modal -->
                                                <div class="modal fade" id="rejectModal{{ $test->id }}" tabindex="-1" aria-labelledby="rejectModalLabel{{ $test->id }}" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <form action="{{ route("tests.reject", $test) }}" method="POST">
                                                                @csrf
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="rejectModalLabel{{ $test->id }}">Reject Test #{{ $test->id }}</h5>
                                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <div class="mb-3">
                                                                        <label for="rejection_reason{{ $test->id }}" class="form-label">Reason for Rejection</label>
                                                                        <textarea class="form-control" id="rejection_reason{{ $test->id }}" name="rejection_reason" rows="3" required></textarea>
                                                                    </div>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                                    <button type="submit" class="btn btn-danger">Reject Test</button>
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
                                        <td colspan="6" class="text-center">No recent tests found.</td>
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

