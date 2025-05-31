<div class="row">
    <div class="col-md-6">
        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" class="form-control @error("name") is-invalid @enderror" id="name" name="name" value="{{ old("name", $device->name ?? "") }}" required>
            @error("name")
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="model" class="form-label">Model</label>
            <input type="text" class="form-control @error("model") is-invalid @enderror" id="model" name="model" value="{{ old("model", $device->model ?? "") }}" required>
            @error("model")
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="serial_number" class="form-label">Serial Number</label>
            <input type="text" class="form-control @error("serial_number") is-invalid @enderror" id="serial_number" name="serial_number" value="{{ old("serial_number", $device->serial_number ?? "") }}" required>
            @error("serial_number")
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="manufacturer" class="form-label">Manufacturer</label>
            <input type="text" class="form-control @error("manufacturer") is-invalid @enderror" id="manufacturer" name="manufacturer" value="{{ old("manufacturer", $device->manufacturer ?? "") }}" required>
            @error("manufacturer")
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="lab_id" class="form-label">Laboratory</label>
            <select class="form-select @error("lab_id") is-invalid @enderror" id="lab_id" name="lab_id" required>
                <option value="">Select Lab</option>
                @foreach($labs as $lab)
                    <option value="{{ $lab->id }}" {{ old("lab_id", $device->lab_id ?? "") == $lab->id ? "selected" : "" }}>{{ $lab->name }}</option>
                @endforeach
            </select>
            @error("lab_id")
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>
    <div class="col-md-6">
        <div class="mb-3">
            <label for="purchase_date" class="form-label">Purchase Date</label>
            <input type="date" class="form-control @error("purchase_date") is-invalid @enderror" id="purchase_date" name="purchase_date" value="{{ old("purchase_date", isset($device->purchase_date) ? $device->purchase_date->format("Y-m-d") : "") }}" required>
            @error("purchase_date")
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="last_calibration_date" class="form-label">Last Calibration Date</label>
            <input type="date" class="form-control @error("last_calibration_date") is-invalid @enderror" id="last_calibration_date" name="last_calibration_date" value="{{ old("last_calibration_date", isset($device->last_calibration_date) ? $device->last_calibration_date->format("Y-m-d") : "") }}">
            @error("last_calibration_date")
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="next_calibration_date" class="form-label">Next Calibration Date</label>
            <input type="date" class="form-control @error("next_calibration_date") is-invalid @enderror" id="next_calibration_date" name="next_calibration_date" value="{{ old("next_calibration_date", isset($device->next_calibration_date) ? $device->next_calibration_date->format("Y-m-d") : "") }}">
            @error("next_calibration_date")
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="status" class="form-label">Status</label>
            <select class="form-select @error("status") is-invalid @enderror" id="status" name="status" required>
                <option value="operational" {{ old("status", $device->status ?? "") == "operational" ? "selected" : "" }}>Operational</option>
                <option value="maintenance" {{ old("status", $device->status ?? "") == "maintenance" ? "selected" : "" }}>Maintenance</option>
                <option value="out_of_order" {{ old("status", $device->status ?? "") == "out_of_order" ? "selected" : "" }}>Out of Order</option>
            </select>
            @error("status")
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>
</div>

