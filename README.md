# Fiddle v2
![Fiddle Logo](https://github.com/zulujive/fiddle/blob/main/logo.png?raw=true)
A reinvented version of PxlsFiddle for the 21st century with a modern design and a clean frontend and backend. Written in PHP, styled to perfection, and organized with scalability in mind.

## Info
This project is in early development. Instances can be run, but there will be performance bottlenecks as there is no caching enabled. Further improvements will be implemented such as client side rendering, full-fledged database, and a bootstrap admin panel to manage templates.

Though it is in development, the server can be safely deployed to production as the underlying source code has been tested extensively.

![Site screenshot](https://github.com/zulujive/fiddle/blob/main/site-example.png?raw=true)

## Deployment
### Requirements
- PHP 8.2 or above
- Web server (NGINX/Apache)

### Instructions
In production, use NGINX or Apache to serve PHP using FastCGI or FPM with "public" being the root directory.

For development instances, you can setup a development server with PHP by navigating into the "public" directory and typing the command (assuming you have PHP installed):
```
php -S localhost:7890
```

It's worth noting that template paths will not contain file extensions for the sake of simplicity. To fix this, go to NGINX's "sites-available" directory and add this configuration:
```
location /templates {
    default_type "image/png";
    add_header Content-Disposition "inline";
}
```
Without this configuration, browsers will automatically download a template image if they open the URL. This change allows for a user to open the template URL and view the image within their browser.
