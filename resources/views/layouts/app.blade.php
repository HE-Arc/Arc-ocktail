<!DOCTYPE html>
<html lang="en" dir="ltr">
    <head>
        <meta charset="utf-8">

        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
        <link href="{{ asset('css/custom.css') }}" rel="stylesheet" type="text/css" >

        <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
        @stack('head')
        <title>@yield('title')</title>
    </head>
    <body style="background-image: url('/uploads/background.jpg');
        background-repeat: no-repeat;
        background-attachment: fixed;
        background-size: cover;">
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark-op-50">
            <div class="container">
                <a class="navbar-brand" href="{{url('/')}}">
                    <img src="{{ asset('icons/logo.png') }}" width="30" height="30" class="d-inline-block align-top" alt="">
                    Arc'ocktail
                </a>

                <form class="form-inline my-2 my-lg-0">
                    <button class="btn btn-outline-success mr-2 my-2 my-sm-0 rounded-0" type="submit">Connexion administrateur</button>
                    <!-- <button class="btn btn-primary my-2 my-sm-0" type="submit">Register</button> -->
                </form>
            </div>
        </nav>

        <div class="container p-3">
            <div class="text-white bg-dark-op-50">
                @yield('content')
                @yield('script')
            </div>
        </div>

        <!-- <footer class="row">
            <div class="col-md-12">Pied de page</div>
        </footer> -->
    </body>
</html>
