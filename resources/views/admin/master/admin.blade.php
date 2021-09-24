<x-admin-layout>
    <div class="py-3">
        <div class="row h-100 g-0">
            <div class="col-lg-12">
                <div class="card border-0 shadow">
                    <div class="card-header p-3 text-uppercase fs-6 fw-bold bg-light border-0 shadow-sm">Master Data Admin</div>
                    <div class="card-body">
                        <div class="row h-100 justify-content-between p-3">
                            <div class="col-auto">
                                @if (auth()->guard('admin')->user()->is_super == 1)
                                <button type="button" class="btn btn-success btn-rounded shadow m-1 btn-open-modal" data-bs-toggle="modal" data-bs-target="#modalDataAdmin"><i class="bi bi-plus-square"></i> Tambah Data</button>
                                @endif
                            </div>
                            <div class="col-auto">
                                <button type="button" class="btn btn-dark btn-rounded shadow m-1 btn-reload-table"><i class="bi bi-arrow-clockwise"></i> Reload Tabel</button>
                            </div>
                        </div>
                        <div class="table-responsive px-3">
                            <table class="table table-striped table-hover align-middle" id="adminTable">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama</th>
                                        <th>Username</th>
                                        <th>Dibuat</th>
                                        <th>Diperbarui</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody></tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="modalDataAdmin" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content border-0">
                <div class="modal-header border-0 shadow-sm bg-light">
                    <h5 class="modal-title text-uppercase fw-bold" id="modalDataAdminLabel">Data Admin</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg">
                            <form action="{{ route('admin.index') }}" method="post" id="formDataAdmin">
                                @csrf
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="username" name="username" placeholder="username" min="6" autofocus required>
                                    <label for="username" id="label_username">Username</label>
                                </div>
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="name" name="name" placeholder="name" required>
                                    <label for="name" id="label_name">Nama</label>
                                </div>
                                <div class="form-floating mb-3">
                                    <input type="password" class="form-control" id="password" name="password" placeholder="password" required>
                                    <label for="password">Password</label>
                                </div>
                            </form>
                            <div class="my-2" id="errorMessage"></div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer border-0 shadow bg-light">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    <button type="button" class="btn btn-primary btn-simpan-edit d-none" id="btn-simpan-edit" data-username="">Simpan Perubahan</button>
                    <button type="button" class="btn btn-primary btn-simpan" id="btn-simpan">Tambah Data</button>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>