<div class="row">
    <div class="col-md-6">
        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" class="form-control @error("name") is-invalid @enderror" id="name" name="name" value="{{ old("name", $user->name ?? "") }}" required>
            @error("name")
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control @error("email") is-invalid @enderror" id="email" name="email" value="{{ old("email", $user->email ?? "") }}" required>
            @error("email")
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">Password {{ isset($user) ? "(Leave blank to keep current)" : "" }}</label>
            <input type="password" class="form-control @error("password") is-invalid @enderror" id="password" name="password" {{ isset($user) ? "" : "required" }}>
            @error("password")
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="password_confirmation" class="form-label">Confirm Password</label>
            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" {{ isset($user) ? "" : "required" }}>
        </div>
    </div>
    <div class="col-md-6">
        <div class="mb-3">
            <label for="roles" class="form-label">Role(s)</label>
            <select class="form-select @error("roles") is-invalid @enderror" id="roles" name="roles[]" multiple required>
                @foreach($roles as $role)
                    <option value="{{ $role->name }}" {{ isset($user) && $user->hasRole($role->name) ? "selected" : "" }}>{{ Str::title($role->name) }}</option>
                @endforeach
            </select>
            @error("roles")
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="lab_id" class="form-label">Laboratory (Optional)</label>
            <select class="form-select @error("lab_id") is-invalid @enderror" id="lab_id" name="lab_id">
                <option value="">Assign to Lab</option>
                @foreach($labs as $lab)
                    <option value="{{ $lab->id }}" {{ old("lab_id", $user->lab_id ?? "") == $lab->id ? "selected" : "" }}>{{ $lab->name }}</option>
                @endforeach
            </select>
            @error("lab_id")
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>
</div>

