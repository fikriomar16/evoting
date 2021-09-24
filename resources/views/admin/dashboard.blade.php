<x-admin-layout>
    <div class="py-4">
        <div class="row">
            <div class="col-xl-3 col-md-6 mb-4">
                <a href="{{ route('user.index') }}" class="card border-primary border-2 rounded-3 shadow h-100 py-2 bg-light text-decoration-none">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col me-2">
                                <div class="text-xs fw-bold text-primary text-uppercase mb-1">Jumlah Pemilih</div>
                                <div class="h5 mb-0 fw-bold text-dark">{{ $user }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="bi bi-person fs-2 text-secondary"></i>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-xl-3 col-md-6 mb-4">
                <a href="{{ route('candidate.index') }}" class="card border-warning border-2 rounded-3 shadow h-100 py-2 bg-light text-decoration-none">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col me-2">
                                <div class="text-xs fw-bold text-warning text-uppercase mb-1">Jumlah Kandidat</div>
                                <div class="h5 mb-0 fw-bold text-dark">{{ $candidate }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="bi bi-people fs-2 text-secondary"></i>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-xl-3 col-md-6 mb-4">
                <a href="{{ route('voting.data') }}" class="card border-success border-2 rounded-3 shadow h-100 py-2 bg-light text-decoration-none">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col me-2">
                                <div class="text-xs fw-bold text-success text-uppercase mb-1">Jumlah Sudah Memilih</div>
                                <div class="h5 mb-0 fw-bold text-dark">{{ $vote }} / {{ $user }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="bi bi-pencil-square fs-2 text-secondary"></i>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-xl-3 col-md-6 mb-4">
                <a href="{{ route('configuration') }}" class="card border-danger border-2 rounded-3 shadow h-100 py-2 bg-light text-decoration-none">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col me-2">
                                <div class="text-xs fw-bold text-danger text-uppercase mb-1">Waktu Pemilihan</div>
                                <div class="h6 mb-0 fw-bold text-dark">{{ date_format(new DateTime($config->start), "d/m/Y") }} - {{ date_format(new DateTime($config->start), "H:i") }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="bi bi-calendar3 fs-2 text-secondary"></i>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>
</x-admin-layout>