<div class="form-floating mb-3">
    <input type="number" class="form-control" id="username" name="username" placeholder="username" min="1" value="{{ old('username', $profile->username) }}" autofocus required>
    <label for="username" id="label_username">NIK</label>
    @error('username')
    <div class="small text-danger py-1">{{ $message }}</div>
    @enderror
</div>
<div class="form-floating mb-3">
    <input type="text" class="form-control" id="name" name="name" placeholder="name" value="{{ old('name', $profile->name) }}" required>
    <label for="name" id="label_name">Nama</label>
    @error('name')
    <div class="small text-danger py-1">{{ $message }}</div>
    @enderror
</div>
<div class="form-floating mb-3">
    <input type="password" class="form-control" id="password" name="password" placeholder="password" value="{{ old('password') }}">
    <label for="password">Password</label>
    @error('password')
    <div class="small text-danger py-1">{{ $message }}</div>
    @enderror
</div>
<div class="form-floating mb-3">
    <input type="date" class="form-control" id="birth_date" name="birth_date" min="1960-01-01" max="2004-01-01" value="{{ old('birth_date', $profile->birth_date) }}" required>
    <label for="birth_date" id="label_birth_date">Tanggal Lahir</label>
    @error('birth_date')
    <div class="small text-danger py-1">{{ $message }}</div>
    @enderror
</div>