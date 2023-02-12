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

    <div class="az-signup-wrapper">
        <div class="az-column-signup-left">
            <div>
                <i class="typcn typcn-chart-bar-outline"></i>
                <h1 class="az-logo">Jhigu<span>Pa</span>Sa</h1>
                <h5>Responsive Modern Dashboard &amp; Admin Template</h5>
                <p>We are excited to launch our new company and product Azia. After being featured in too many magazines
                    to mention and having created an online stir, we know that BootstrapDash is going to be big. We also
                    hope to win Startup Fictional Business of the Year this year.</p>
                <p>Browse our site and see for yourself why you need Azia.</p>
                <a href="index.html" class="btn btn-outline-indigo">Learn More</a>
            </div>
        </div>
        <!-- az-column-signup-left -->
        <div class="az-column-signup">
            <h1 class="az-logo">Jhigu<span>Pa</span>Sa</h1>
            <div class="az-signup-header">
                <h2>Get Started</h2>
                <h4>It's free to signup and only takes a minute.</h4>

                <form method="POST" action="{{ route('register') }}">
                    @csrf
                    <!-- form-name -->
                    <div class="form-group">
                        <label for="name">Firstname &amp; Lastname</label>
                        <input id="name" name="name" type="text" class="form-control"
                            placeholder="Enter your firstname and lastname">
                        @error('name')
                            <p class="my-1 text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <!-- form-email -->
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input id="email" name="email" type="text" class="form-control"
                            placeholder="Enter your email">
                        @error('email')
                            <p class="my-1 text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <!-- form-password -->
                    <div class="form-group">
                        <label>Password</label>
                        <input id="password" name="password" type="password" class="form-control"
                            placeholder="Enter your password">
                        @error('password')
                            <p class="my-1 text-danger">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- form-password_confirmation -->
                    <div class="form-group">
                        <label>Confirm Password</label>
                        <input id="password_confirmation" name="password_confirmation" type="password"
                            class="form-control" placeholder="Enter your password">
                        @error('password_confirmation')
                            <p class="my-1 text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-az-primary btn-block">Create Account</button>

                    <!-- row -->
                </form>
            </div><!-- az-signup-header -->

            @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                <div class="mt-4">
                    <x-jet-label for="terms">
                        <div class="flex items-center">
                            <x-jet-checkbox name="terms" id="terms" />

                            <div class="ml-2">
                                {!! __('I agree to the :terms_of_service and :privacy_policy', [
                                    'terms_of_service' =>
                                        '<a target="_blank" href="' .
                                        route('terms.show') .
                                        '" class="underline text-sm text-gray-600 hover:text-gray-900">' .
                                        __('Terms of Service') .
                                        '</a>',
                                    'privacy_policy' =>
                                        '<a target="_blank" href="' .
                                        route('policy.show') .
                                        '" class="underline text-sm text-gray-600 hover:text-gray-900">' .
                                        __('Privacy Policy') .
                                        '</a>',
                                ]) !!}
                            </div>
                        </div>
                    </x-jet-label>
                </div>
            @endif

            <div class="az-signup-footer">
                <p>Already have an account? <a href="{{ route('login') }}">Sign In</a></p>
            </div><!-- az-signin-footer -->
        </div><!-- az-column-signup -->
    </div><!-- az-signup-wrapper -->

    <script src="../lib/jquery/jquery.min.js"></script>
    <script src="../lib/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../lib/ionicons/ionicons.js"></script>
    <script src="../js/jquery.cookie.js" type="text/javascript"></script>

    <script src="../js/azia.js"></script>
    <script>
        $(function() {
            'use strict'

        });
    </script>
</body>

</html>
