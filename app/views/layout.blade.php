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
<!-- Header -->
    <!-- Non-phone Header -->
            <div class="row hidden-xs" id="page-header" style="background: url({{ Asset('assets/images/banner.jpg') }}) center no-repeat;">
                <div class="col-xs-1">
                    <img id="wwu-logo"
                         src="{{asset('assets/images/westernlogo_sm_white.png')}}"
                         style="padding: 1em;
                         margin-left: 10%;
                         background-color:#003f87;
                         position: relative;
                         z-index: 2" />
                </div>
                <div class="col-xs-11"
                     style="background-color:#2b7cd1;
                     margin: 0;
                     position:absolute;
                     width: 100%;
                     top: 2em">
                    <div class="row" id="bannertitle">
                        <h3 class="col-xs-9" style="color: white; margin-top: 0.4em; margin-bottom: 0.4em">Western Washington University Ride Sharing</h3>
                        <div class="col-xs-3 text-right" style="margin-top: 0.4em; margin-bottom: 0.4em">
                            <div style="color: white; display: inline-block">
                                Logged in as <b><a style="color: white" href="{{ route('users.show', $currentUser->id) }}">{{ $currentUser->user_name }}</a></b>
                            </div>
                            <div style="padding-left: 1em; text-align: right; color: white; display: inline-block">
                                <b><a style="color: white" href="?logout">(Logout)</a></b>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    <!-- /Non-phone Header -->
    <!-- Phone Header -->
            <div class="row visible-xs">
                <h1 class="col-xs-8">WWU Ride Sharing</h1>
                <div class="col-xs-4 text-right">
                    <div>
                        Logged in as <b><a href="{{ route('users.show', $currentUser->id) }}">{{ $currentUser->user_name }}</a></b>
                    </div>
                    <div>
                        <b><a href="?logout">(Logout)</a></b>
                    </div>
                </div>
            </div>
    <!-- /Phone Header -->
<!-- /Header -->
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
        // Window Load event. Inject JS functions in a windowLoadEvent section
        $(window).load(function() {
            setPageHeaderOffset();
            @yield('windowLoadEvent')
        });
        $(window).resize(function(){
            setPageHeaderOffset();
            @yield('windowResizeEvent')
        })
    </script>
    @yield('footer-resources')
</html>
