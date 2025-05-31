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
                        <textarea class="form-control @error("results") is-invalid @enderror" id="results{{ $test->id }}" name="results" rows="5" required>{{ old("results", isset($test->results) ? json_encode($test->results, JSON_PRETTY_PRINT) : "{\n    \"parameter_1\": \"value_1\",\n    \"parameter_2\": \"value_2\"\n}") }}</textarea>
                        <small class="form-text text-muted">Enter results as key-value pairs, e.g., {"density": 0.85, "unit": "g/cm3"}</small>
                        @error("results")
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="notes{{ $test->id }}" class="form-label">Notes (Optional)</label>
                        <textarea class="form-control @error("notes") is-invalid @enderror" id="notes{{ $test->id }}" name="notes" rows="3">{{ old("notes", $test->notes ?? "") }}</textarea>
                         @error("notes")
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
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

