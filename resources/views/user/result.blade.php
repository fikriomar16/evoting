<x-user-layout>
    <div class="py-3">
        <div class="row h-100 g-0 my-lg-5 justify-content-center">
            <div class="col-lg my-auto">
                <div class="card border-0 shadow">
                    <div class="card-header text-center fs-3 fw-bold text-uppercase p-3 border-0 shadow-sm">
                        Hasil Pemilihan
                    </div>
                    <div class="card-body p-3">
                        <div class="d-flex justify-content-end my-3 mx-lg-5 mx-3">
                            <button class="btn btn-dark btn-rounded shadow btn-reload m-1"><i class="bi bi-arrow-clockwise"></i> Muat Ulang Data</button>
                            <button class="btn btn-dark btn-rounded shadow btn-loading m-1 d-none" type="button" disabled>
                                <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                                Loading...
                            </button>
                        </div>
                        <div class="row h-100 justify-content-center" id="dataVote" data-asset="{{ Storage::url('candidate') }}/">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-user-layout>