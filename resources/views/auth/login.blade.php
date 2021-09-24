<x-user-layout>
    <div class="py-3" id="loginPage">
        <div class="row h-100 g-0 justify-content-center">
            <div class="col-lg-4 my-auto">
                <div class="card border-0 shadow">
                    <div class="card-header text-center fs-3 fw-bold text-uppercase p-3 border-0 shadow-sm">
                        Masuk
                    </div>
                    <div class="card-body p-3">
                        <form action="{{ route('login') }}" method="post" id="formLogin">
                            @csrf
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control text-center fs-5" id="username" name="username" placeholder="username" value="{{ old('username') }}" autofocus required>
                                <label for="username" id="label_username">NIK / Username</label>
                                @error('username')
                                <div class="small text-danger py-1">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-floating mb-3">
                                <input type="password" class="form-control text-center fs-5" id="password" name="password" placeholder="password" value="{{ old('password') }}" required>
                                <label for="password">Password</label>
                                @error('password')
                                <div class="small text-danger py-1">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="m-3">
                                <p class="fw-bold mx-2">Masuk sebagai :</p>
                                <div class="form-check form-switch form-switch-lg">
                                    <input class="form-check-input" type="checkbox" id="login_as" name="login_as">
                                    <label class="form-check-label px-3 py-2" for="login_as" id="label_login_as">Pemilih</label>
                                </div>
                            </div>
                            <div class="my-4">
                                <div class="d-grid gap-2 col-lg-6 mx-auto my-1">
                                    <button type="submit" class="btn btn-rounded btn-lg btn-primary"><i class="bi bi-box-arrow-in-right"></i> Masuk</button>
                                </div>
                            </div>
                            <small class="d-block text-center p-3">Belum Terdaftar? <a href="{{ route('register') }}" class="text-decoration-none fw-bold">Buat Akun!</a></small>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-user-layout>