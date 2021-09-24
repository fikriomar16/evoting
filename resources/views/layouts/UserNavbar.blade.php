<nav class="navbar navbar-expand-lg sticky-top navbar-light text-uppercase navbar-shrink rounded-bottom bg-blur" id="mainNav">
    <div class="container">
        <a class="navbar-brand fw-bold mx-5" href="/">{{ config('app.name', 'E-Voting App') }}</a>
        <button class="navbar-toggler border-0 shadow-md rounded mx-3" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <i class="bi bi-filter-left display-3"></i>
        </button>
        <div class="collapse navbar-collapse justify-content-between" id="navbarNav">
            <div class="navbar-nav p-3">
                <a class="nav-link {{ Request::is('/') ? 'active' : '' }}" href="{{ route('homepage') }}">Beranda</a>
                <a class="nav-link {{ Request::routeIs('announcement') ? 'active' : '' }}" href="{{ route('announcement') }}">Pengumuman</a>
                <a class="nav-link {{ Request::routeIs('voting') ? 'active' : '' }}" href="{{ route('voting') }}">Pemilihan</a>
                <a class="nav-link {{ Request::routeIs('voting.result') ? 'active' : '' }}" href="{{ route('voting.result') }}">Hasil Pemilihan</a>
            </div>
            <div class="navbar-nav p-3">
                @if (auth()->guard('admin')->check())
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown">
                        <i class="bi bi-person"></i> {{ auth()->guard('admin')->user()->name }} (Admin)
                    </a>
                    <ul class="dropdown-menu border-0 shadow-sm">
                        <li><a class="dropdown-item" href="{{ route('dashboard') }}"><i class="bi bi-speedometer2"></i> Dashboard</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li>
                            <form action="{{ route('logout.admin') }}" method="post">
                                @csrf
                                <button type="submit" class="dropdown-item border-0 rounded text-uppercase"><i class="bi bi-box-arrow-right"></i> Keluar</button>
                            </form>
                        </li>
                    </ul>
                </li>
                @else
                @auth
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown">
                        <i class="bi bi-person"></i> {{ auth()->user()->name }}
                    </a>
                    <ul class="dropdown-menu border-0 shadow-sm">
                        <li><a class="dropdown-item" href="{{ route('profile') }}"><i class="bi bi-person-bounding-box"></i> Profil</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li>
                            <form action="{{ route('logout') }}" method="post">
                                @csrf
                                <button type="submit" class="dropdown-item border-0 rounded text-uppercase"><i class="bi bi-box-arrow-right"></i> Keluar</button>
                            </form>
                        </li>
                    </ul>
                </li>
                @else
                <a class="nav-link {{ Request::routeIs('login') ? 'active' : '' }}" href="{{ route('login') }}"><i class="bi bi-box-arrow-in-right"></i> Masuk</a>
                <a class="nav-link {{ Request::routeIs('register') ? 'active' : '' }}" href="{{ route('register') }}"><i class="bi bi-box-arrow-in-down"></i> Mendaftar</a>
                @endauth
                @endif
            </div>
        </div>
    </div>
</nav>