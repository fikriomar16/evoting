<x-user-layout>
    <div class="py-3">
        <div class="row h-100 g-0 py-5 justify-content-center align-self-center">
            <div class="col-lg-4 my-auto">
                <div class="card border-0 shadow">
                    <div class="card-header text-center fs-3 fw-bold text-uppercase p-3 border-0 shadow-sm">
                        Profil
                    </div>
                    <div class="card-body p-4">
                        <form action="" method="post">
                            @method('put')
                            @csrf
                            <x-form-user :profile="$profile"></x-form-user>
                            <div class="my-4">
                                <div class="d-grid gap-2 col-lg-6 mx-auto my-1">
                                    <button type="submit" class="btn btn-rounded btn-lg btn-warning"><i class="bi bi-pencil"></i> Edit Profile</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-user-layout>