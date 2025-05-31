<div class="row">
    <div class="col-md-6">
        <div class="mb-3">
            <label for="sample_id" class="form-label">Sample</label>
            <select class="form-select @error("sample_id") is-invalid @enderror" id="sample_id" name="sample_id" required {{ isset($test) ? "disabled" : "" }}>
                <option value="">Select Sample</option>
                @foreach($samples as $sampleOption)
                    <option value="{{ $sampleOption->id }}" 
                        {{ old("sample_id", $test->sample_id ?? request("sample_id")) == $sampleOption->id ? "selected" : "" }}>
                        {{ $sampleOption->sample_id }} ({{ Str::title(str_replace("_", " ", $sampleOption->sample_type)) }})
                    </option>
                @endforeach
            </select>
            @if(isset($test))
                <input type="hidden" name="sample_id" value="{{ $test->sample_id }}">
            @endif
            @error("sample_id")
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="test_type" class="form-label">Test Type</label>
            <select class="form-select @error("test_type") is-invalid @enderror" id="test_type" name="test_type" required>
                <option value="">Select Test Type</option>
                <option value="density" {{ old("test_type", $test->test_type ?? "") == "density" ? "selected" : "" }}>Density</option>
                <option value="viscosity" {{ old("test_type", $test->test_type ?? "") == "viscosity" ? "selected" : "" }}>Viscosity</option>
                <option value="flash_point" {{ old("test_type", $test->test_type ?? "") == "flash_point" ? "selected" : "" }}>Flash Point</option>
                <option value="pour_point" {{ old("test_type", $test->test_type ?? "") == "pour_point" ? "selected" : "" }}>Pour Point</option>
                <option value="water_content" {{ old("test_type", $test->test_type ?? "") == "water_content" ? "selected" : "" }}>Water Content</option>
                <option value="sulfur_content" {{ old("test_type", $test->test_type ?? "") == "sulfur_content" ? "selected" : "" }}>Sulfur Content</option>
                <option value="composition" {{ old("test_type", $test->test_type ?? "") == "composition" ? "selected" : "" }}>Composition Analysis</option>
                <option value="other" {{ old("test_type", $test->test_type ?? "") == "other" ? "selected" : "" }}>Other</option>
            </select>
            @error("test_type")
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="method" class="form-label">Method (ASTM)</label>
            <input type="text" class="form-control @error("method") is-invalid @enderror" id="method" name="method" value="{{ old("method", $test->method ?? "") }}" required placeholder="e.g., ASTM D4052">
            @error("method")
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="device_id" class="form-label">Device (Optional)</label>
            <select class="form-select @error("device_id") is-invalid @enderror" id="device_id" name="device_id">
                <option value="">Select Device</option>
                @foreach($devices as $device)
                    <option value="{{ $device->id }}" {{ old("device_id", $test->device_id ?? "") == $device->id ? "selected" : "" }}>{{ $device->name }} ({{ $device->serial_number }})</option>
                @endforeach
            </select>
            @error("device_id")
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>
    <div class="col-md-6">
        <div class="mb-3">
            <label for="assigned_to" class="form-label">Assign To (Optional)</label>
            <select class="form-select @error("assigned_to") is-invalid @enderror" id="assigned_to" name="assigned_to">
                <option value="">Assign Technician</option>
                @foreach($technicians as $technician)
                    <option value="{{ $technician->id }}" {{ old("assigned_to", $test->assigned_to ?? "") == $technician->id ? "selected" : "" }}>{{ $technician->name }}</option>
                @endforeach
            </select>
            @error("assigned_to")
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="status" class="form-label">Status</label>
            <select class="form-select @error("status") is-invalid @enderror" id="status" name="status" required>
                <option value="pending" {{ old("status", $test->status ?? "pending") == "pending" ? "selected" : "" }}>Pending</option>
                <option value="in_progress" {{ old("status", $test->status ?? "") == "in_progress" ? "selected" : "" }}>In Progress</option>
                <option value="completed" {{ old("status", $test->status ?? "") == "completed" ? "selected" : "" }}>Completed</option>
                <option value="approved" {{ old("status", $test->status ?? "") == "approved" ? "selected" : "" }}>Approved</option>
                <option value="rejected" {{ old("status", $test->status ?? "") == "rejected" ? "selected" : "" }}>Rejected</option>
            </select>
            @error("status")
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="notes" class="form-label">Notes</label>
            <textarea class="form-control @error("notes") is-invalid @enderror" id="notes" name="notes" rows="4">{{ old("notes", $test->notes ?? "") }}</textarea>
            @error("notes")
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        @if(isset($test) && $test->results)
        <div class="mb-3">
            <label for="results" class="form-label">Results (JSON)</label>
            <textarea class="form-control @error("results") is-invalid @enderror" id="results" name="results" rows="5">{{ old("results", json_encode($test->results, JSON_PRETTY_PRINT)) }}</textarea>
            @error("results")
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        @endif
    </div>
</div>

