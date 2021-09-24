<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv='cache-control' content='no-cache'>
    <meta http-equiv='expires' content='0'>
    <meta http-equiv='pragma' content='no-cache'>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs5/jq-3.6.0/dt-1.11.2/b-2.0.0/b-print-2.0.0/date-1.1.1/fc-3.3.3/fh-3.1.9/r-2.2.9/datatables.min.css"/>
    <link rel="stylesheet" href="{{ asset('/assets/css/app.css') }}">
    @if (Request::is('dashboard/candidate*') || Request::is('dashboard/configuration'))
    <link rel="stylesheet" href="{{ asset('/assets/css/trix.css') }}">
    <style>
        trix-toolbar [data-trix-button-group="file-tools"] {
            display:none;
        }
    </style>
    @endif
    <link rel="shortcut icon" href="/assets/img/icon.png" type="image/x-icon">
    <title>{{ config('app.name', 'E-Voting App') }} | Dashboard</title>
</head>
<body class="font-inter">
    @if (session()->has('success'))
    <div class="bg-success py-3 px-5 text-white">{{ session('success') }}</div>
    @endif
    @if (session()->has('error'))
    <div class="bg-danger py-3 px-5 text-white">{{ session('error') }}</div>
    @endif
    @if (session()->has('warning'))
    <div class="bg-warning py-3 px-5 text-dark">{{ session('warning') }}</div>
    @endif
    @include('layouts.AdminNavbar')
    <div class="container">
        {{ $slot }}
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>
    {{-- Datatable : BS5, jQ360, Ext(Button-print preview, DateTime, FixedColumn, FixedHeader, Responsive),  --}}
    <script type="text/javascript" src="https://cdn.datatables.net/v/bs5/jq-3.6.0/dt-1.11.2/b-2.0.0/b-print-2.0.0/date-1.1.1/fc-3.3.3/fh-3.1.9/r-2.2.9/datatables.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{ asset('/assets/js/app.js') }}"></script>
    <script src="{{ asset('/assets/js/admin.js') }}"></script>
    <script src="{{ asset('/assets/js/notif.js') }}"></script>
    @if (Request::is('dashboard/user*'))
    <script src="{{ asset('/assets/js/master_user.js') }}"></script>
    @endif
    @if (Request::is('dashboard/candidate*') || Request::is('dashboard/configuration'))
    <script src="{{ asset('/assets/js/trix.js') }}"></script>
    @endif
    @if (Request::is('dashboard/candidate*'))
    <script src="{{ asset('/assets/js/master_candidate.js') }}"></script>
    @endif
    @if (Request::is('dashboard/admin*'))
    <script src="{{ asset('/assets/js/master_admin.js') }}"></script>
    @endif
    @if (Request::is('dashboard/configuration'))
    <script src="{{ asset('/assets/js/configuration.js') }}"></script>
    @endif
    @if (Request::is('dashboard/voting_data'))
    <script src="{{ asset('/assets/js/votingdata.js') }}"></script>
    @endif
</body>
</html>