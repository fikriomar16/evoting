<x-user-layout>
    <div class="pt-5 pb-0 pb-lg-3 rounded align-middle" id="homePage">
        <div class="row h-100 g-0 mb-5 justify-content-center">
            <div class="col-lg-6 my-auto">
                <div class="text-center mx-auto">
                    <img src="/assets/img/evotelogo.png" class="img-fluid img-responsive rounded-3 shadow-sm" alt="evote">
                </div>
            </div>
            <div class="col-lg my-lg-auto">
                <div class="card border-0 py-3 bg-transparent">
                    <div class="card-body">
                        <div class="text-dark pb-2 text-center rounded" id="infoHome">
                            <h2 class="fw-bold mb-4 text-uppercase">Selamat Datang di {{ config('app.name', 'E-Voting App') }}</h2>
                            <h4 class="my-2">{{ $config->event_name }}</h4>
                            <p class=""><em>Alamat : {{ $config->location }}</em></p>
                        </div>
                        <div class="align-self-center text-center m-3">
                            <a href="{{ route('announcement') }}" class="btn btn-rounded btn-lg btn-dark border-0 shadow-lg">
                                <i class="bi bi-arrow-right"></i>&nbsp; Selanjutnya
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-user-layout>