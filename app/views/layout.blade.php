<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Ride Sharing and Book Selling</title>

        <script src="http://code.jquery.com/jquery-latest.min.js" type="text/javascript"></script>
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css">

        <!-- Optional theme -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap-theme.min.css">

        <!-- Latest compiled and minified JavaScript -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js"></script>
        <link href="https://fonts.googleapis.com/css?family=Muli:400,300" rel="stylesheet" type="text/css" />
        @yield('resources')
    </head>
    <body>
        <div class="col-md-2">
        </div>
        <div class="col-md-8">
        @yield('content')
        @yield('footer-resources')
        </div>
        <div class="col-md-2"></div>
    </body>
</html>
