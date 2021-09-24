<x-user-layout>
    <div class="py-3" id="registerPage">
        <div class="row h-100 g-0 justify-content-center">
            <div class="col-lg-4 my-auto">
                <div class="card border-0 shadow">
                    <div class="card-header text-center fs-3 fw-bold text-uppercase p-3 border-0 shadow-sm">
                        Mendaftar
                    </div>
                    <div class="card-body p-3">
                        <form action="{{ route('register') }}" method="post" id="formRegister">
                            @csrf
                            <x-form-user :profile="$profile"></x-form-user>
                            <div class="my-4">
                                <div class="d-grid gap-2 col-lg-6 mx-auto my-1">
                                    <button type="submit" class="btn btn-rounded btn-lg btn-primary"><i class="bi bi-box-arrow-in-down"></i> Mendaftar</button>
                                </div>
                            </div>
                            <small class="d-block text-center p-3">Sudah Memiliki Akun? <a href="{{ route('login') }}" class="text-decoration-none fw-bold">Masuk</a></small>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-user-layout>