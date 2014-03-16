<html>
    <head>
        <title>Ride Sharing and Book Selling</title>
        <link rel='stylesheet' href='{{asset('assets/css/style.css')}}' />

    </head>
    <body>
        <div class="page-header">
            <div class="header-wwu-logo">
            </div>
            
            @yield('header-title')
            <a href='?logout='><img src='{{asset('assets/images/3.png')}}' title='Logout'></a>
            <a href='{{ action('UsersController@show', $current_user->id) }}'><img src='{{asset('assets/images/25.png')}}' title='User Settings'></a>    
            <a href="#"><img src='{{asset('assets/images/10.png')}}' title='Messages'></a>

        </div>
        <div class="container">
            @yield('content')
        </div>
    </body>
</html>