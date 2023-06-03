# Fiddle v2
![Fiddle Logo](https://github.com/zulujive/fiddle/blob/main/logo.png?raw=true)
A reinvented version of PxlsFiddle for the 21st century with a modern design and a clean frontend and backend. Written in PHP, styled to perfection, and organized with scalability in mind.

**Note: This project is not affiliated with PxlsFiddle in any way**

## Info
This project is in early development. Instances can be run, but there will be performance bottlenecks as there is no caching enabled. Further improvements will be implemented such as client side rendering, full-fledged database, and a bootstrap admin panel to manage templates.

Though it is in development, the server can be safely deployed to production as the underlying source code has been tested extensively.

![Site screenshot](https://github.com/zulujive/fiddle/blob/main/site-example.png?raw=true)

## Features
- Laravel-style routing
- CSRF protection
- Boostrap admin panel (coming soon)
- Highly scalable architecture
- Beautiful design from top to bottom

## Deployment
### Requirements
- PHP 8.2 or above
- Web server (NGINX/Apache)
- PHP Composer

### Instructions
In production, use NGINX or Apache to serve PHP using FastCGI or FPM with "public" being the root directory.

For development instances, you can setup a development server with PHP by navigating into the "public" directory and typing the command (assuming you have PHP installed):
```
php -S localhost:7890 index.php
```

It's worth noting that template paths will not contain file extensions for the sake of simplicity. To fix this, go to NGINX's "sites-available" directory and add this configuration:
```
location /templates {
    default_type "image/png";
    add_header Content-Disposition "inline";
}
```
Without this configuration, browsers will automatically download a template image if they open the URL. This change allows for a user to open the template URL and view the image within their browser.

**Note: This is only if you're not using routes. If you are using routes, this does not apply**

## In-depth Overview
Fiddle runs on a design philosophy similar to that of many other PHP frameworks. Modularity and security take front and center, with every piece of code being isolated and easily swappable whilst the server is running. Abstraction between frontend and backend modules allows for improved security and componentization.

### Routing
Fiddle uses the Bramus router library to handle routing various requests. In terms of syntax, Bramus is practically identical to Laravel's routing library. 

The decision to use a router instead of a more conventional approach because of the advantages in scalability and organization of source code. Keeping backend scripts from being directly accessible makes for more robust access control and rate limiting. In addition, using routes allows for middleware support in the near future.

### Application Structure
The application is structured into two main directories. The public directory is intended to be used for content that is directly accessible without the use of routes, though it is recommended that it's used sparingly as access control can become problematic in non-route pages.

The src folder contains both backend and frontend scripts. Directories inside of it function as follows:
- Controllers handle incoming requests that are assigned to them in index.php
- Resources contain mostly frontend content that apply to largely client-side services
- Storage is used for any sort of data that is referenced by other scripts.
    - Data handles structured application data
    - Templates is a public-facing directory that contains templates hosted on the site. Do remember that template URLs NEVER include a file extension as this seems to cause issues with the web server handling GET requests.
- Web is currently an unused directory and its contents does not impact application funcitonality (unless there is a fatal syntax error). In other words, don't mess with it, it's not important but will be in the future.

### Admin Panel
The admin panel is currently under development. It uses Bootstrap for styling and has already been equipped with CSRF protection. It'll likely be connected to a SQL database, but no decision has been made regarding what SQL server will be used. As of right now, the login page has yet to be fully implemented with the restructuring that resulted in many paths referenced in the code being unusable.

### Stack
Of course, what application would be complete without a tech stack? Ultimately, the plan is to run the application on a PB²&J (PHP, Bootstrap, PocketBase, and Javascript) stack. PocketBase is the planned database as it's easy to use, open source and perfect for an application of this size.

## Roadmap
- [ ] Docker implementation
- [x] Routes
- [x] CSRF Protection
- [ ] Admin Panel (in progress)
- [x] Maintenance Mode
- [ ] Database connection (in progress)
- [ ] Oauth2 w/ Database
- [ ] First Stable Release
- [ ] Using database for templates
- [ ] Adding an upload utility
- [ ] Detangling code (in progress)