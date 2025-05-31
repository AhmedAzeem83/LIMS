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
                        <textarea class="form-control @error("rejection_reason") is-invalid @enderror" id="rejection_reason{{ $test->id }}" name="rejection_reason" rows="3" required>{{ old("rejection_reason") }}</textarea>
                        @error("rejection_reason")
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
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

