@php
    use Carbon\Carbon;
    $data = session()->get('notification');
@endphp

<!DOCTYPE html>
<html lang="en">

<head>
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
    {{-- <link href="/../lib/flag-icon-css/css/flag-icon.min.css" rel="stylesheet"> --}}


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

    <div class="az-content">
        <div class="container-fluid">
            @include('admin.common.sidebar')
            <div class="az-content-body pd-lg-l-40 d-flex flex-column">
                @yield('main_content')
                <div class="ht-40"></div>
            </div><!-- az-content-body -->
        </div><!-- container -->
    </div><!-- az-content -->


    <div class="toast_container">
        <div class="toaster" id="liveToast">
            <div class="toast_body" id="toastBody" data-alert="{{ $data ? $data['alert'] : '' }}"
                data-message="{{ $data ? $data['message'] : '' }}">
                <ion-icon name="checkmark-circle" class="mx-1 icon-size"></ion-icon>
            </div>
        </div>
    </div>

    <!-- az-footer starts -->
    @include('admin.common.footer')
    <!-- az-footer ends -->
</body>

</html>
