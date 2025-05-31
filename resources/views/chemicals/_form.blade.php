<div class="row">
    <div class="col-md-6">
        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" class="form-control @error("name") is-invalid @enderror" id="name" name="name" value="{{ old("name", $chemical->name ?? "") }}" required>
            @error("name")
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="cas_number" class="form-label">CAS Number</label>
            <input type="text" class="form-control @error("cas_number") is-invalid @enderror" id="cas_number" name="cas_number" value="{{ old("cas_number", $chemical->cas_number ?? "") }}">
            @error("cas_number")
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="category" class="form-label">Category</label>
            <input type="text" class="form-control @error("category") is-invalid @enderror" id="category" name="category" value="{{ old("category", $chemical->category ?? "") }}" required>
            @error("category")
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="quantity" class="form-label">Quantity</label>
            <input type="number" step="0.01" class="form-control @error("quantity") is-invalid @enderror" id="quantity" name="quantity" value="{{ old("quantity", $chemical->quantity ?? "") }}" required>
            @error("quantity")
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="unit" class="form-label">Unit</label>
            <input type="text" class="form-control @error("unit") is-invalid @enderror" id="unit" name="unit" value="{{ old("unit", $chemical->unit ?? "") }}" required>
            @error("unit")
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>
    <div class="col-md-6">
        <div class="mb-3">
            <label for="location" class="form-label">Location</label>
            <input type="text" class="form-control @error("location") is-invalid @enderror" id="location" name="location" value="{{ old("location", $chemical->location ?? "") }}" required>
            @error("location")
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="expiry_date" class="form-label">Expiry Date</label>
            <input type="date" class="form-control @error("expiry_date") is-invalid @enderror" id="expiry_date" name="expiry_date" value="{{ old("expiry_date", isset($chemical->expiry_date) ? $chemical->expiry_date->format("Y-m-d") : "") }}">
            @error("expiry_date")
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="msds_file" class="form-label">MSDS File (PDF, DOC, DOCX)</label>
            <input type="file" class="form-control @error("msds_file") is-invalid @enderror" id="msds_file" name="msds_file">
            @if(isset($chemical) && $chemical->msds_file)
                <small class="form-text text-muted">Current file: <a href="{{ Storage::url($chemical->msds_file) }}" target="_blank">View MSDS</a></small>
            @endif
            @error("msds_file")
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="lab_id" class="form-label">Laboratory</label>
            <select class="form-select @error("lab_id") is-invalid @enderror" id="lab_id" name="lab_id" required>
                <option value="">Select Lab</option>
                @foreach($labs as $lab)
                    <option value="{{ $lab->id }}" {{ old("lab_id", $chemical->lab_id ?? "") == $lab->id ? "selected" : "" }}>{{ $lab->name }}</option>
                @endforeach
            </select>
            @error("lab_id")
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>
</div>

