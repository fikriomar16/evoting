<x-user-layout>
    <div class="py-3">
        <div class="row h-100 g-0 justify-content-center pb-5">
            <div class="col-lg my-auto">
                <div class="card border-0 shadow rounded bg-light" id="cardCandidates">
                    <div class="card-header border-0 text-center text-uppercase p-3 text-dark shadow-sm">
                        <h3 class="fw-bold">Pilih Kandidat</h3>
                    </div>
                    <div class="card-body">
                        <div class="row justify-content-center g-5" id="listKandidat">
                            @php $no = 0; @endphp
                            @foreach ($candidates as $candidate)
                            @php $no++; @endphp
                            <div class="col-lg-4 col-md-6">
                                <div class="card border-0 shadow-sm rounded-3">
                                    <img src="{{ asset('storage/candidate/'.$candidate->foto) }}" class="card-img-top img-fluid" alt="...">
                                    <div class="card-body">
                                        <p class="text-center fw-bold fs-3">Kandidat {{ $no }}</p>
                                        <p class="card-title text-center fs-6">
                                            {{ $candidate->nama_calon }} <br> {{ $candidate->nama_wakil_calon }}
                                        </p>
                                    </div>
                                    <div class="card-footer border-0 bg-light">
                                        <div class="row justify-content-between text-center">
                                            <div class="d-grid gap-2 col-5 mx-auto my-1">
                                                <button class="btn btn-rounded btn-outline-dark btnDetailCandidate" data-id="{{ $candidate->id }}" type="button">
                                                    <i class="bi bi-card-list"></i> Detail
                                                </button>
                                            </div>
                                            <div class="d-grid gap-2 col-7 mx-auto my-1">
                                                @if (!\App\Models\Vote::find(auth()->id()))
                                                <button class="btn btn-rounded btn-primary btnSelectCandidate" data-url="{{ route('voting.candidate', $candidate->id) }}" data-id="{{ $candidate->id }}" data-calon="{{ $candidate->nama_calon }}" data-wakil="{{ $candidate->nama_wakil_calon }}" data-kandidat="Kandidat {{ $no }}" type="button">
                                                    <i class="bi bi-hand-index-thumb"></i> Pilih Kandidat {{ $no }}
                                                </button>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-user-layout>