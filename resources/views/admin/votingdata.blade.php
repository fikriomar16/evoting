<x-admin-layout>
    <div class="py-3">
        <div class="row h-100 g-0 justify-content-center">
            <div class="col-lg">
                <div class="card border-0 shadow">
                    <div class="card-header p-3 text-uppercase fs-6 fw-bold bg-light border-0 shadow-sm">Ringkasan Perhitungan</div>
                    <div class="card-body">
                        <div class="row h-100 justify-content-center" id="dataVote">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row h-100 g-0">
            <div class="col-lg-12">
                <div class="card border-0 shadow">
                    <div class="card-header p-3 text-uppercase fs-6 fw-bold bg-light border-0 shadow-sm">Hasil Data Pemilihan</div>
                    <div class="card-body">
                        <div class="row h-100 justify-content-between p-3">
                            <div class="col-auto">
                                <button type="button" class="btn btn-dark btn-rounded shadow m-1 btn-reload-table"><i class="bi bi-arrow-clockwise"></i> Reload Data</button>
                            </div>
                        </div>
                        <div class="table-responsive px-3">
                            <table class="table table-striped table-hover align-middle" id="voteTable">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Pemilih</th>
                                        <th>Kandidat</th>
                                        <th>IP</th>
                                        <th>OS</th>
                                        <th>Browser</th>
                                        <th>Waktu Vote</th>
                                        {{-- created at --}}
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
</x-admin-layout>