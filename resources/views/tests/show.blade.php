@extends("layouts.app")

@section("title", "Test Details: #" . $test->id)

@section("content")
<div class="container-fluid">
    <h1 class="h3 mb-2 text-gray-800">Test Details: #{{ $test->id }} for Sample <a href="{{ route("samples.show", $test->sample) }}">{{ $test->sample->sample_id }}</a></h1>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Test Information</h6>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <p><strong>Test ID:</strong> {{ $test->id }}</p>
                    <p><strong>Sample ID:</strong> <a href="{{ route("samples.show", $test->sample) }}">{{ $test->sample->sample_id }}</a></p>
                    <p><strong>Sample Type:</strong> {{ Str::title(str_replace("_", " ", $test->sample->sample_type)) }}</p>
                    <p><strong>Test Type:</strong> {{ Str::title(str_replace("_", " ", $test->test_type)) }}</p>
                    <p><strong>Method (ASTM):</strong> {{ $test->method }}</p>
                    <p><strong>Lab:</strong> <a href="{{ route("labs.show", $test->sample->lab) }}">{{ $test->sample->lab->name }}</a></p>
                </div>
                <div class="col-md-6">
                    <p><strong>Status:</strong> <span class="{{ $test->status_badge }}">{{ Str::title(str_replace("_", " ", $test->status)) }}</span></p>
                    <p><strong>Assigned To:</strong> {{ $test->assignedUser?->name ?? "N/A" }}</p>
                    <p><strong>Started At:</strong> {{ $test->started_at ? $test->started_at->format("Y-m-d H:i:s") : "N/A" }}</p>
                    <p><strong>Completed At:</strong> {{ $test->completed_at ? $test->completed_at->format("Y-m-d H:i:s") : "N/A" }}</p>
                    <p><strong>Approved By:</strong> {{ $test->approver?->name ?? "N/A" }}</p>
                    <p><strong>Created At:</strong> {{ $test->created_at->format("Y-m-d H:i:s") }}</p>
                    <p><strong>Updated At:</strong> {{ $test->updated_at->format("Y-m-d H:i:s") }}</p>
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-md-12">
                    <p><strong>Notes:</strong> {{ $test->notes ?? "N/A" }}</p>
                    @if($test->status === "rejected")
                        <p><strong>Rejection Reason:</strong> {{ $test->rejection_reason ?? "N/A" }}</p>
                    @endif
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-md-12">
                    <p><strong>Results:</strong></p>
                    @if($test->results)
                        <pre class="bg-light p-3 rounded"><code>{{ json_encode($test->results, JSON_PRETTY_PRINT) }}</code></pre>
                    @else
                        <p>No results recorded yet.</p>
                    @endif
                </div>
            </div>
            <hr>
            <a href="{{ route("tests.index") }}" class="btn btn-secondary">Back to List</a>
            @can("manage tests")
            <a href="{{ route("tests.edit", $test) }}" class="btn btn-warning">Edit Test</a>
            @endcan
            @if($test->status === "pending" && Auth::user()->can("perform tests"))
                <form action="{{ route("tests.start", $test) }}" method="POST" class="d-inline">
                    @csrf
                    <button type="submit" class="btn btn-primary">Start Test</button>
                </form>
            @elseif($test->status === "in_progress" && Auth::user()->can("perform tests") && $test->assigned_to === Auth::id())
                <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#completeModal{{ $test->id }}">
                    Complete Test
                </button>
                @include("tests._complete_modal")
            @elseif($test->status === "completed" && Auth::user()->can("approve tests"))
                <form action="{{ route("tests.approve", $test) }}" method="POST" class="d-inline">
                    @csrf
                    <button type="submit" class="btn btn-success">Approve Test</button>
                </form>
                <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#rejectModal{{ $test->id }}">
                    Reject Test
                </button>
                @include("tests._reject_modal")
            @endif
        </div>
    </div>
</div>
@endsection

