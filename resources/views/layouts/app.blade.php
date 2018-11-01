<!DOCTYPE html>
<html lang="en" dir="ltr">
    <head>
        <meta charset="utf-8">
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <link href="{{ asset('css/custom.css') }}" rel="stylesheet" type="text/css" >

        <!-- jQuery library -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

        <!-- Latest compiled JavaScript -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <title>@yield('title')</title>
    </head>
    <body>
        <header class="row">
            <div class="col-md-12">Entete</div>
		</header>
        @yield('content')
        <footer class="row">
		          <div class="col-md-12">Pied de page</div>
		</footer>
    </body>
</html>
