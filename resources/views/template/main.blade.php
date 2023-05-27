<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    {{-- bootstrap  --}}
    <link rel="stylesheet" href="{{ asset('bootstrap-5.3.0/css/bootstrap.css') }}">

    {{-- jquery --}}
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <!-- Boxiocns CDN Link -->
    <link href="https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css" rel="stylesheet" />

    {{-- icon --}}
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css'
        integrity='sha512-1sCRPdkRXhBV2PBLUdRb4tMg1w2YPf37qatUFeS7zlBy7jJI8Lf4VHwWfZZfpXtYSLy85pkm9GaYVYMfw5BC1A=='
        crossorigin='anonymous' />
    <script src='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/js/all.min.js'
        integrity='sha512-8pHNiqTlsrRjVD4A/3va++W1sMbUHwWxxRPWNyVlql3T+Hgfd81Qc6FC5WMXDC+tSauxxzp1tgiAvSKFu1qIlA=='
        crossorigin='anonymous'></script>

    {{-- datatable --}}
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css">

    {{-- datatable button --}}
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.3.6/css/buttons.bootstrap5.min.css">

    {{-- datatable responsive --}}
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.4.1/css/responsive.dataTables.min.css">

    {{-- My Code --}}
    <link rel="stylesheet" href="{{ asset('sidebar/style.css') }}" />
    <link rel="stylesheet" href="{{ asset('custom/style.css') }}" />


    <title>Document</title>
</head>

<body>
    {{-- sidebar --}}
    @include('template.sidebar')

    <section class="home-section">

        <div class="home-content">
            <i class="bx bx-menu"></i>
            <button id="scrollButton" class="btn btn-primary"><i class='bx bx-down-arrow-alt'></i></button>
            <button id="scrollToTopButton" class="btn btn-primary"><i class='bx bx-up-arrow-alt'></i></button>
        </div>

        <div class="wrapper mt-5">
            @yield('content')
        </div>

    </section>



</body>

{{-- bootstrap --}}
<script src="{{ asset('bootstrap-5.3.0/js/bootstrap.js') }}"></script>
<script src="{{ asset('bootstrap-5.3.0/js/bootstrap.bundle.js') }}"></script>

{{-- customize --}}
<script src="{{ asset('sidebar/script.js') }}"></script>

{{-- datatable --}}
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>

{{-- datatable button --}}
<script src="https://cdn.datatables.net/buttons/2.3.6/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.3.6/js/buttons.bootstrap5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.3.6/js/buttons.colVis.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.3.6/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.3.6/js/buttons.print.min.js"></script>

{{-- datatable responsive --}}
<script src="https://cdn.datatables.net/responsive/2.4.1/js/dataTables.responsive.min.js"></script>

{{-- CkEditor --}}
<script src="https://cdn.ckeditor.com/ckeditor5/37.1.0/classic/ckeditor.js"></script>

{{-- MyCode --}}
<script src="{{ asset('custom/script.js') }}"></script>



</html>
