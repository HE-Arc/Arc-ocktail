<!DOCTYPE html>
<html lang="en" dir="ltr">
    <head>
        <meta charset="utf-8">
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
        <link href="{{ asset('css/custom.css') }}" rel="stylesheet" type="text/css" >

        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
        <title>@yield('title')</title>
    </head>
    <body>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container">
            <a class="navbar-brand" href="#">
                <img src="{{ asset('icons/logo.png') }}" width="30" height="30" class="d-inline-block align-top" alt="">
                Arc'ocktail
            </a>

            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>


                <form class="form-inline my-2 my-lg-0">
                    <button class="btn btn-outline-primary mr-2 my-2 my-sm-0" type="submit">
                        <span class="glyphicon glyphicon-tint" aria-hidden="true"></span>Login
                        </button>
                    <button class="btn btn-primary my-2 my-sm-0" type="submit">Register</button>
                </form>
            </div>
        </div>
    </nav>
        @yield('content')
        <footer class="row">
		          <div class="col-md-12">Pied de page</div>
		</footer>
    </body>
</html>
