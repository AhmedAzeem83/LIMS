<div class="row">
    <div class="col-md-6">
        <div class="mb-3">
            <label for="sample_id" class="form-label">Sample ID</label>
            <input type="text" class="form-control @error("sample_id") is-invalid @enderror" id="sample_id" name="sample_id" value="{{ old("sample_id", $sample->sample_id ?? "") }}" required>
            @error("sample_id")
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="client_name" class="form-label">Client Name</label>
            <input type="text" class="form-control @error("client_name") is-invalid @enderror" id="client_name" name="client_name" value="{{ old("client_name", $sample->client_name ?? "") }}" required>
            @error("client_name")
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="sample_type" class="form-label">Sample Type</label>
            <select class="form-select @error("sample_type") is-invalid @enderror" id="sample_type" name="sample_type" required>
                <option value="">Select Type</option>
                <option value="crude_oil" {{ old("sample_type", $sample->sample_type ?? "") == "crude_oil" ? "selected" : "" }}>Crude Oil</option>
                <option value="natural_gas" {{ old("sample_type", $sample->sample_type ?? "") == "natural_gas" ? "selected" : "" }}>Natural Gas</option>
                <option value="lpg" {{ old("sample_type", $sample->sample_type ?? "") == "lpg" ? "selected" : "" }}>LPG</option>
                <option value="glycol" {{ old("sample_type", $sample->sample_type ?? "") == "glycol" ? "selected" : "" }}>Glycol</option>
                <option value="lubricating_oil" {{ old("sample_type", $sample->sample_type ?? "") == "lubricating_oil" ? "selected" : "" }}>Lubricating Oil</option>
                <option value="water" {{ old("sample_type", $sample->sample_type ?? "") == "water" ? "selected" : "" }}>Water</option>
                <option value="other" {{ old("sample_type", $sample->sample_type ?? "") == "other" ? "selected" : "" }}>Other</option>
            </select>
            @error("sample_type")
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="received_date" class="form-label">Received Date</label>
            <input type="date" class="form-control @error("received_date") is-invalid @enderror" id="received_date" name="received_date" value="{{ old("received_date", isset($sample->received_date) ? $sample->received_date->format("Y-m-d") : date("Y-m-d")) }}" required>
            @error("received_date")
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="collection_date" class="form-label">Collection Date</label>
            <input type="date" class="form-control @error("collection_date") is-invalid @enderror" id="collection_date" name="collection_date" value="{{ old('collection_date', isset($sample->collection_date) ? $sample->collection_date->format('Y-m-d') : date('Y-m-d')) }}" required>
            @error("collection_date")
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>
    <div class="col-md-6">
        <div class="mb-3">
            <label for="lab_id" class="form-label">Laboratory</label>
            <select class="form-select @error("lab_id") is-invalid @enderror" id="lab_id" name="lab_id" required>
                <option value="">Select Lab</option>
                @foreach($labs as $lab)
                    <option value="{{ $lab->id }}" {{ old("lab_id", $sample->lab_id ?? Auth::user()->lab_id) == $lab->id ? "selected" : "" }}>{{ $lab->name }}</option>
                @endforeach
            </select>
            @error("lab_id")
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="status" class="form-label">Status</label>
            <select class="form-select @error("status") is-invalid @enderror" id="status" name="status" required>
                <option value="received" {{ old("status", $sample->status ?? "received") == "received" ? "selected" : "" }}>Received</option>
                <option value="in_progress" {{ old("status", $sample->status ?? "") == "in_progress" ? "selected" : "" }}>In Progress</option>
                <option value="completed" {{ old("status", $sample->status ?? "") == "completed" ? "selected" : "" }}>Completed</option>
                <option value="disposed" {{ old("status", $sample->status ?? "") == "disposed" ? "selected" : "" }}>Disposed</option>
            </select>
            @error("status")
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="notes" class="form-label">Notes</label>
            <textarea class="form-control @error("notes") is-invalid @enderror" id="notes" name="notes" rows="4">{{ old("notes", $sample->notes ?? "") }}</textarea>
            @error("notes")
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>
</div>

