<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-90680653-2"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'UA-90680653-2');
    </script>

    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Meta -->
    <meta name="description" content="Responsive Bootstrap 4 Dashboard Template">
    <meta name="author" content="BootstrapDash">

    <title>{{ config('app.name') }}</title>

    <!-- vendor css -->
    <link href="../lib/fontawesome-free/css/all.min.css" rel="stylesheet">
    <link href="../lib/ionicons/css/ionicons.min.css" rel="stylesheet">
    <link href="../lib/typicons.font/typicons.css" rel="stylesheet">

    <!-- azia CSS -->
    <link rel="stylesheet" href="../css/azia.css">

</head>

<body class="az-body">

    <div class="az-signin-wrapper">
        <div class="az-card-signin">
            <h1 class="az-logo">Jhigu<span>Pa</span>sa</h1>
            <div class="az-signin-header">
                <h2>Welcome back!</h2>
                <h4>Please sign in to continue</h4>




                @if (session('status'))
                    <div class="mb-4 font-medium text-sm text-green-600">
                        {{ session('status') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="form-group">
                        <label>Email</label>
                        <input type="text" id="password" name="email" value='{{ old('email') }}'
                            class="form-control" placeholder="Enter your email">
                        @error('email')
                            <p class="my-1 text-danger">{{ $message }}</p>
                        @enderror
                    </div><!-- form-group -->


                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" id="password" name="password" class="form-control"
                            placeholder="Enter your password">
                        @error('password')
                            <p class="my-1 text-danger">{{ $message }}</p>
                        @enderror
                    </div><!-- form-group -->


                    <div class="form-group">
                        <label for="remember_me" class="flex items-center">
                            <x-jet-checkbox id="remember_me" name="remember" />
                            <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                        </label>
                    </div>
                    <button class="btn btn-az-primary btn-block">Sign In</button>
                </form>
            </div><!-- az-signin-header -->
            <div class="az-signin-footer">
                @if (Route::has('password.request'))
                    <p><a href="{{ route('password.request') }}">Forgot password?</a></p>
                @endif
                <p>Don't have an account? <a href="{{ route('register') }}">Create an Account</a></p>
            </div><!-- az-signin-footer -->
        </div><!-- az-card-signin -->

    </div><!-- az-signin-wrapper -->


    <script src="../lib/jquery/jquery.min.js"></script>
    <script src="../lib/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../lib/ionicons/ionicons.js"></script>
    <script src="../js/jquery.cookie.js" type="text/javascript"></script>
    <script src="../js/jquery.cookie.js" type="text/javascript"></script>

    <script src="../js/azia.js"></script>
    <script>
        $(function() {
            'use strict'

        });
    </script>
</body>

</html>
