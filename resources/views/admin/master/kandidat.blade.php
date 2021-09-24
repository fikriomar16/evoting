<x-admin-layout>
    <div class="py-3">
        <div class="row h-100 g-0">
            <div class="col-lg-12">
                <div class="card border-0 shadow">
                    <div class="card-header p-3 text-uppercase fs-6 fw-bold bg-light border-0 shadow-sm">Master Data Kandidat</div>
                    <div class="card-body">
                        <div class="row h-100 justify-content-between p-3">
                            <div class="col-auto">
                                <button type="button" class="btn btn-success btn-rounded shadow m-1 btn-open-modal" data-bs-toggle="modal" data-bs-target="#modalDataCandidate"><i class="bi bi-plus-square"></i> Tambah Data</button>
                            </div>
                            <div class="col-auto">
                                <button type="button" class="btn btn-dark btn-rounded shadow m-1 btn-reload-table"><i class="bi bi-arrow-clockwise"></i> Reload Tabel</button>
                            </div>
                        </div>
                        <div class="table-responsive px-3">
                            <table class="table table-striped table-hover align-middle" id="candidateTable">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>No Identitas</th>
                                        <th>Kandidat</th>
                                        <th>Foto</th>
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
    <div class="modal fade" id="modalDataCandidate" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
            <div class="modal-content border-0">
                <div class="modal-header border-0 shadow-sm bg-light">
                    <h5 class="modal-title text-uppercase fw-bold" id="modalDataCandidateLabel">Data Kandidat</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg">
                            <form action="{{ route('candidate.index') }}" enctype="multipart/form-data" method="post" id="formDataCandidate">
                                @csrf
                                <div class="row">
                                    <div class="col-lg">
                                        <div class="form-floating mb-3">
                                            <input type="number" class="form-control" id="id_calon" name="id_calon" placeholder="No Identitas Calon" min="1" autofocus required>
                                            <label for="id_calon">No Identitas Calon</label>
                                        </div>
                                    </div>
                                    <div class="col-lg">
                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control" id="nama_calon" name="nama_calon" placeholder="Nama Calon" min="1" required>
                                            <label for="nama_calon">Nama Calon</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg">
                                        <div class="form-floating mb-3">
                                            <input type="number" class="form-control" id="id_wakil_calon" name="id_wakil_calon" placeholder="No Identitas Wakil Calon" min="1" required>
                                            <label for="id_wakil_calon">No Identitas Wakil Calon</label>
                                        </div>
                                    </div>
                                    <div class="col-lg">
                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control" id="nama_wakil_calon" name="nama_wakil_calon" placeholder="Nama Wakil Calon" min="1" required>
                                            <label for="nama_wakil_calon">Nama Wakil Calon</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="visi" class="form-label">Visi</label>
                                    <input id="visi" type="hidden" name="visi">
                                    <trix-editor input="visi"></trix-editor>
                                </div>
                                <div class="mb-3">
                                    <label for="misi" class="form-label">Misi</label>
                                    <input id="misi" type="hidden" name="misi">
                                    <trix-editor input="misi"></trix-editor>
                                </div>
                                <div class="mb-3">
                                    <label for="foto" class="form-label">Upload Foto Kandidat</label>
                                    <input class="form-control" type="file" id="foto" name="foto" accept="image/*" data-src="{{ Storage::url('candidate') }}/">
                                    <p class="small text-danger p-1">*Max: 1MB</p>
                                    <div class="row justify-content-center">
                                        <div class="col-lg-auto">
                                            <img src="" class="img-fluid img-responsive rounded-3 shadow-sm" id="image-preview">
                                        </div>
                                    </div>
                                </div>
                            </form>
                            <div class="my-2" id="errorMessage"></div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer border-0 shadow bg-light">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    <button type="button" class="btn btn-primary btn-simpan-edit d-none" id="btn-simpan-edit" data-id="">Simpan Perubahan</button>
                    <button type="button" class="btn btn-primary btn-simpan" id="btn-simpan">Tambah Data</button>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>