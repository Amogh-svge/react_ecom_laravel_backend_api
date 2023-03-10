@php
    use Carbon\Carbon;
    $data = session()->get('notification');
@endphp

<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Global site tag (gtag.js) - Google Analytics -->
    {{-- <script async src="https://www.googletagmanager.com/gtag/js?id=UA-90680653-2"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'UA-90680653-2');
    </script> --}}

    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Meta -->
    <meta name="description" content="Responsive Bootstrap 4 Dashboard Template">
    <meta name="author" content="BootstrapDash">

    <title>{{ config('app.name') }}</title>

    <!-- vendor css -->
    <link href="/../lib/ionicons/css/ionicons.min.css" rel="stylesheet">
    <link href="/../lib/fontawesome-free/css/all.min.css" rel="stylesheet">
    <link href="/../lib/typicons.font/typicons.css" rel="stylesheet">
    <link href="/../lib/flag-icon-css/css/flag-icon.min.css" rel="stylesheet">


    <!-- azia CSS -->
    <link rel="stylesheet" href="/../css/azia.css">
    <!-- main CSS -->
    <link rel="stylesheet" href="/../css/main.css">


    <!-- datatables plugin -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.2/css/jquery.dataTables.css">
    <!--end datatables-->


</head>

<body>
    <!-- az-header starts -->
    @include('admin.common.header')
    <!-- az-header ends -->

    <div class="az-content container az-content-dashboard">
        <!-- content-body starts -->
        <div class="az-content-body">
            {{-- nav bar starts --}}
            @include('admin.common.navbar')
            {{-- nav bar ends --}}
            @yield('main_content')
        </div>
        <!-- content-body ends -->
    </div><!-- az-content -->

    <div class="toast_container">
        <div class="toaster" id="liveToast">
            <div class="toast_body" id="toastBody" data-alert="{{ $data ? $data['alert'] : '' }}"
                data-message="{{ $data ? $data['message'] : '' }}">
                <ion-icon name="checkmark-circle" class="mx-1 icon-size"></ion-icon>
            </div>
        </div>
    </div>


    <!-- az-footer start -->
    @include('admin.common.footer')
    <!-- az-footer ends -->
</body>

</html>
