<x-user-layout>
    <div class="py-3" id="announcementPage">
        <div class="row h-100 g-0 justify-content-center pb-2">
            <div class="col-lg-6 my-auto">
                <div class="card border-0 shadow">
                    <div class="card-header text-center fs-3 fw-bold text-uppercase p-3 border-0 shadow-sm">
                        Pengumuman
                    </div>
                    <div class="card-body p-3">
                        <div class="display-2 text-center my-3">
                            <i class="bi bi-layout-text-sidebar-reverse text-primary"></i>
                        </div>
                        {!! $config->announcement !!}
                        <hr>
                        <p class="fs-6">
                            Sesi {{ $config->event_name }} akan diselenggarakan pada :
                        </p>
                        <ul class="fs-6">
                            <li>Tanggal : {{ date_format(new DateTime($config->start), "d/m/Y") }}</li>
                            <li>Pukul : {{ date_format(new DateTime($config->start), "H:i") }}</li>
                        </ul>
                        <p class="fs-6">
                            Dan akan berakhir pada :
                        </p>
                        <ul class="fs-6">
                            <li>Tanggal : {{ date_format(new DateTime($config->end), "d/m/Y") }}</li>
                            <li>Pukul : {{ date_format(new DateTime($config->end), "H:i") }}</li>
                        </ul>
                        <div class="align-self-center text-center m-3">
                            <a href="{{ route('voting') }}" class="btn btn-rounded btn-lg btn-dark border-0 shadow-lg">
                                <i class="bi bi-arrow-right"></i>&nbsp; Menuju Pemilihan
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-user-layout>