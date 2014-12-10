# Ride Sharing Web Application Doccumentation

## User Documentation

User documentation isn't really needed, as the app is quite simple and intuitive. We believe any end-user would be able to use our app with little to no difficulty, at least, for now as submitted.

## Developer Documentation

This one is a bit more complicated.

#### Enviroment Setup

The Ride Sharing app is written in laravel, so you'll need to first set up a laravel development enviroment.

Laravel requires php5.4 or greater, so make sure you have that installed on your development machine before continuing.

After cloning the repository you will need to download composer, which manages the dependencies of the project for you. Get it via https://getcomposer.org/download/ and put it in the root directory of the project. Then simply run `php composer update`. You will need php-cli. Now go make a coffee while composer sets up the dependencies for you; it will take a minute or two.

After composer sets up the project dependencies, you will need to set up your database. Pick whatever flavor of database engine you'd like to use and make a user and database for this project. Then add a `/app/config/database.php` file with the database connection information. A example is provided in `/app/config/database.php.example` with mysql as the driver.

You can now try to migrate the tables with `php artisan migrate`. If you hit an error, either your database information hasn't been filled out correctly or php is missing the driver extension for the database engine you picked.

After building the tables, you can run the app in a development enviroment with `php artisan serve`, which should put the site up at localhost:8000/.

To put the app on a server for production, you should install and configure a webserver. A sample nginx configuration for this app is:

```server {

    # Port that the web server will listen on.
    listen 80;

    # The location of our projects public directory.
    root /home/user/rsbs/public;

    # Point index to the Laravel front controller.
    index index.php;

    location / {
        # URLs to attempt, including pretty ones.
        try_files   $uri $uri/ /index.php?$query_string;
    }

    # Remove trailing slash to please routing system.
    if (!-d $request_filename) {
        rewrite     ^/(.+)/$ /$1 permanent;
    }

    # PHP FPM configuration.
    location ~* \.php$ {
            fastcgi_pass                    unix:/var/run/php5-fpm.sock;
            fastcgi_index                   index.php;
            fastcgi_split_path_info         ^(.+\.php)(.*)$;
            include                         /etc/nginx/fastcgi_params;
            fastcgi_param                   SCRIPT_FILENAME $document_root$fastcgi_script_name;
    }

    # We don't need .ht files with nginx.
    location ~ /\.ht {
            deny all;
    }

}
```

Permission problems will likely ensue, so you should fix those and make sure nginx has write access to `/app/storage/`.

