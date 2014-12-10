<!DOCTYPE html>
<html lang="en">
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Ride Sharing and Book Selling</title>

        <script src="http://code.jquery.com/jquery-latest.min.js" type="text/javascript"></script>
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css">
        <!-- Optional theme -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap-theme.min.css">
        <!-- Latest compiled and minified JavaScript -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js"></script>
        <script type="text/javascript">
            function isBreakpoint( alias ) {
                return $('.device-' + alias).is(':visible');
            }
        </script>

        <link href="https://fonts.googleapis.com/css?family=Muli:400,300" rel="stylesheet" type="text/css" />
        @yield('resources')
    </head>
    <body>
        <div class="container-fluid">
<!-- Headers -->
    <!-- Non-phone Header -->
            <div class="row hidden-xs" id="page-header">
                <div class="col-xs-12" style="background-color:#003f87; margin: 0; padding: 0; width: 100%; position:relative">
                    <a href="/"><img id="wwu-logo" src="{{asset('assets/images/logo_small.png')}}" style="position:absolute; left: 0; top:50%; height:30px; margin-top: -15px; margin-left: 10px" />
                    <h3 style="color: white; margin-left: 100px; margin-top: 0.6em; margin-bottom: 0.6em; float: left; color: #42b6e8; font-family: Georgia, serif">Western Washington University Ride Sharing</h3></a>
                    <div style="margin-top: 0.4em; margin-right: 0.4em; float: right">
                        <div style="color: white; display: inline-block">
                            Logged in as <b><a style="color: white" href="{{ route('users.show', $currentUser->id) }}">{{ $currentUser->user_name }}</a></b>
                        </div>
                        <div style="padding-left: 1em; text-align: right; color: white; display: inline-block">
                            <b><a style="color: white" href="?logout">(Logout)</a></b>
                        </div>
                    </div>
                </div>
            </div>
    <!-- /Non-phone Header -->
    <!-- Phone Header -->
            <div class="row visible-xs" style="background-color:#003f87">
                <a href="/"><h1 class="col-xs-8" style="margin-top: 0.4em; margin-bottom: 0.4em; font-family: Georgia, serif; color: #42b6e8">Western Ride Sharing</h1></a>
                <div class="col-xs-4 text-right" style="color:white">
                    <div>
                        Logged in as <b><a style="color: white" href="{{ route('users.show', $currentUser->id) }}">{{ $currentUser->user_name }}</a></b>
                    </div>
                    <div>
                        <b><a style="color: white" href="?logout">(Logout)</a></b>
                    </div>
                </div>
            </div>
    <!-- /Phone Header -->
<!-- /Headers -->
            <div class="clearfix"></div>
<!-- Page Content -->
            @yield('content')
<!-- /Page Content -->
        </div>
        <!-- Divs to allow checking of screen size in JS using isBreakpoint('xs'); -->
        <div class="device-xs visible-xs"></div>
        <div class="device-sm visible-sm"></div>
        <div class="device-md visible-md"></div>
        <div class="device-lg visible-lg"></div>
    </body>
    <script type="text/javascript">
        function setPageHeaderOffset() {
            var element = document.getElementById("wwu-logo");
            var wwuLogo = $('#wwu-logo');
            var logoRight = wwuLogo.position().left + wwuLogo.outerWidth();
            var offset = logoRight + 20;

            var docWidth = $(document).outerWidth();

            document.getElementById("bannertitle").style.marginLeft = offset + "px";
            document.getElementById("bannertitle").style.right = docWidth + "px";
        }
        function setLogoSize(){
            
        }
        // Window Load event. Inject JS functions in a windowLoadEvent section
        $(window).load(function() {
            //setPageHeaderOffset();
            @yield('windowLoadEvent')
        });
        $(window).resize(function(){
            //setPageHeaderOffset();
            @yield('windowResizeEvent')
        })
    </script>
    @yield('footer-resources')
</html>
