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
        
        <script type="text/javascript">
            window.onresize = function(event) {
                document.getElementById("bannertitle").style.marginLeft = window.innerWidth * 0.2 + 220 + "px";
            }
            window.onload = function(event){
                document.getElementById("bannertitle").style.marginLeft = window.innerWidth * 0.2 + 220 + "px";
            }
        </script>
    </head>
    <body>
    
        <div class="row" id="page-header" style="padding-bottom: 3%; background-image: url('<?php echo asset('assets/images/banner.jpg') ?>'); background-position: center; background-repeat: no-repeat; margin: 0">
            <div class="row text-right" style="color:white; position:absolute; width: 100%; z-index: 20">
                Logged in as <b><a href="{{ route('users.show', $currentUser->id) }}">{{ $currentUser->user_name }}</a></b>&nbsp;&nbsp;
                <b><a href="?logout">(Logout)</a></b>
            </div>
            <a href="/">
                <div class="row" style="background-color:#2b7cd1; position:absolute; width: 100%; top: 2em; padding: 0; margin: 0">
                    <h3 id="bannertitle" class="text-left" style="color: white; margin-top: 0.4em; margin-bottom: 0.4em; margin-left: 0">Western Washington University Ride Sharing</h3>
                </div>
                <div class="col-lg-12" style="margin: 0; padding:0">    
                    <img src="{{asset('assets/images/westernlogo_sm_white.png')}}" style="margin-left: 20%; padding: 1em; background-color:#003f87; position: relative" />
                </div>
            </a>
        </div>
        <div class="col-md-2"></div>
        <div class="col-md-8">            
        @yield('content')
        @yield('footer-resources')
        </div>
        <div class="col-md-2"></div>
    </body>
</html>
