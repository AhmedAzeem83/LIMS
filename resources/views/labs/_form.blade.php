<div class="mb-3">
    <label for="name" class="form-label">Name</label>
    <input type="text" class="form-control @error("name") is-invalid @enderror" id="name" name="name" value="{{ old("name", $lab->name ?? "") }}" required>
    @error("name")
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="mb-3">
    <label for="location" class="form-label">Location</label>
    <input type="text" class="form-control @error("location") is-invalid @enderror" id="location" name="location" value="{{ old("location", $lab->location ?? "") }}" required>
    @error("location")
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="mb-3">
    <label for="description" class="form-label">Description</label>
    <textarea class="form-control @error("description") is-invalid @enderror" id="description" name="description" rows="3">{{ old("description", $lab->description ?? "") }}</textarea>
    @error("description")
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="mb-3">
    <label for="status" class="form-label">Status</label>
    <select class="form-select @error("status") is-invalid @enderror" id="status" name="status" required>
        <option value="active" {{ old("status", $lab->status ?? "") == "active" ? "selected" : "" }}>Active</option>
        <option value="inactive" {{ old("status", $lab->status ?? "") == "inactive" ? "selected" : "" }}>Inactive</option>
        <option value="maintenance" {{ old("status", $lab->status ?? "") == "maintenance" ? "selected" : "" }}>Maintenance</option>
    </select>
    @error("status")
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

