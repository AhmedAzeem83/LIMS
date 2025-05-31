<div class="row">
    <div class="col-md-6">
        <div class="mb-3">
            <label for="device_id" class="form-label">Device</label>
            <select class="form-select @error("device_id") is-invalid @enderror" id="device_id" name="device_id" required {{ isset($calibration) ? "disabled" : "" }}>
                <option value="">Select Device</option>
                @foreach($devices as $deviceOption)
                    <option value="{{ $deviceOption->id }}" 
                        {{ old("device_id", $calibration->device_id ?? request("device_id")) == $deviceOption->id ? "selected" : "" }}>
                        {{ $deviceOption->name }} ({{ $deviceOption->serial_number }})
                    </option>
                @endforeach
            </select>
            @if(isset($calibration))
                <input type="hidden" name="device_id" value="{{ $calibration->device_id }}">
            @endif
            @error("device_id")
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="calibration_date" class="form-label">Calibration Date</label>
            <input type="date" class="form-control @error("calibration_date") is-invalid @enderror" id="calibration_date" name="calibration_date" value="{{ old("calibration_date", isset($calibration->calibration_date) ? $calibration->calibration_date->format("Y-m-d") : date("Y-m-d")) }}" required>
            @error("calibration_date")
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="next_due_date" class="form-label">Next Due Date</label>
            <input type="date" class="form-control @error("next_due_date") is-invalid @enderror" id="next_due_date" name="next_due_date" value="{{ old("next_due_date", isset($calibration->next_due_date) ? $calibration->next_due_date->format("Y-m-d") : "") }}" required>
            @error("next_due_date")
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>
    <div class="col-md-6">
        <div class="mb-3">
            <label for="status" class="form-label">Status</label>
            <select class="form-select @error("status") is-invalid @enderror" id="status" name="status" required>
                <option value="pending" {{ old("status", $calibration->status ?? "pending") == "pending" ? "selected" : "" }}>Pending</option>
                <option value="passed" {{ old("status", $calibration->status ?? "") == "passed" ? "selected" : "" }}>Passed</option>
                <option value="failed" {{ old("status", $calibration->status ?? "") == "failed" ? "selected" : "" }}>Failed</option>
            </select>
            @error("status")
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="certificate" class="form-label">Certificate (PDF, DOC, DOCX, JPG, PNG)</label>
            <input type="file" class="form-control @error("certificate") is-invalid @enderror" id="certificate" name="certificate">
            @if(isset($calibration) && $calibration->certificate)
                <small class="form-text text-muted">Current file: <a href="{{ Storage::url($calibration->certificate) }}" target="_blank">View Certificate</a></small>
            @endif
            @error("certificate")
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="notes" class="form-label">Notes</label>
            <textarea class="form-control @error("notes") is-invalid @enderror" id="notes" name="notes" rows="4">{{ old("notes", $calibration->notes ?? "") }}</textarea>
            @error("notes")
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>
</div>

