# Fiddle v2
![Fiddle Logo](https://github.com/zulujive/fiddle/blob/main/logo.png?raw=true)
A reinvented version of PxlsFiddle for the 21st century with a modern design and a clean frontend and backend. Written in PHP, styled to perfection, and organized with scalability in mind.

**Note: This project is not affiliated with PxlsFiddle in any way**

## Info
This project is in early development. Instances can be run, but there will be performance bottlenecks as there is no caching enabled. Further improvements will be implemented such as client side rendering, full-fledged database, and a bootstrap admin panel to manage templates.

Though it is in development, the server can be safely deployed to production as the underlying source code has been tested extensively.

![Site screenshot](https://github.com/zulujive/fiddle/blob/main/site-example.png?raw=true)

![Admin panel screenshot](https://github.com/zulujive/fiddle/blob/main/admin-example.png?raw=true)

![2FA Verification screenshot](https://github.com/zulujive/fiddle/blob/main/2fa-example.png?raw=true)

## Features
- Laravel-style routing
- CSRF protection
- Multi-factor Authentication Support
- Boostrap admin panel (in progress)
- Highly scalable architecture
- Beautiful design from top to bottom
- Simple and easy deployment

## Deployment
### Requirements
- PHP 8.2 or above
- Web server (NGINX/Apache)
- PHP Composer
- PocketBase

### Instructions
In production, use NGINX or Apache to serve PHP using FastCGI or FPM and only serving index.php. Do not serve the entire public directory as it will result in unintended 404 errors.

To get the database setup, start a pocketbase instance running on port 8090 (required that it's 8090 for now) and import the "pocketbase.json" file to PocketBase as a collection.

You can easily start the server at port 7890 with this command within the root directory:
```
php fiddle serve
```

## In-depth Overview
Fiddle runs on a design philosophy similar to that of many other PHP frameworks. Modularity and security take front and center, with every piece of code being isolated and easily swappable whilst the server is running. Abstraction between frontend and backend modules allows for improved security and componentization.

### Routing
Fiddle uses the Bramus router library to handle routing various requests. In terms of syntax, Bramus is practically identical to Laravel's routing library. 

The decision to use a router instead of a more conventional approach because of the advantages in scalability and organization of source code. Keeping backend scripts from being directly accessible makes for more robust access control and rate limiting. In addition, using routes allows for middleware support in the near future.

### Application Structure
The application is structured into two main directories. The public directory was originally intended to be accessible without routes, but is there to be a much more simple way of routing pages since it's in the same directory as index.php. Only use it for testing, it's not a place for clutter.

The src folder contains both backend and frontend scripts. Directories inside of it function as follows:
- Controllers handle incoming requests that are assigned to them in index.php
- Resources contain mostly frontend content that apply to largely client-side services
- Storage is used for any sort of data that is referenced by other scripts.
    - Data handles structured application data
    - Templates is a public-facing directory that contains templates hosted on the site. Do remember that template URLs NEVER include a file extension as this seems to cause issues with the web server handling GET requests.
- Web is currently an unused directory and its contents does not impact application funcitonality (unless there is a fatal syntax error). In other words, don't mess with it, it's not important but will be in the future.

### Admin Panel
The admin panel is currently under development. It uses Bootstrap for styling and has already been equipped with CSRF protection. It's connected to the PocketBase database which handles various security measures. Create a user in PocketBase in the "Admin" collection and login to the admin panel at /login

### Stack
Of course, what application would be complete without a tech stack? Ultimately, the plan is to run the application on a PB²&J (PHP, Bootstrap, PocketBase, and Javascript) stack. PocketBase is the database as it's easy to use, open source and perfect for an application of this size. Currently, PocketBase implementation is a little limited, but basic authentication support has been added to the admin panel as well as a moderator creation utility within it.

PocketBase was the backend of choice here due to its easy implementation and powerful features. Namely, it automatically hashes, stores, authenticates and salts passwords, making handling logins as simple as sending a single POST request. Additionally, it's incredibly simmple to setup, allowing for quick deployment as compared to alternatives such as FireBase. Currently, a more easy system to communicate with PB is being setup and will be implemented soon.

### Security
A lot of work has been put into refining the security of the application. As mentioned before, CSRF protection is built-in and can be easily implemented into any form by using the Csrf class and methods. Additionally, session cookies are set to be good for one hour and have a strict cross site policy.

If you'd like to implement CSRF into a form as a developer, simply begin a session in a PHP page within the "views" folder, then add the class with:
```
require_once __DIR__ . '/../methods/Csrf.php';
```
Then, generate/fetch a new token:
```
$csrfToken = Csrf::generateToken();
```
Implement it into your form with this:
```
<input type="hidden" name="csrf_token" value="<?php echo $csrfToken; ?>">
```
Finally, in whatever script you have that received the POST request, make sure you've required the class and with the correct directory, start a session, and use this class on the first line of code that receives the POST request:
```
Csrf::verifyToken();
```
Doing those simple steps will prevent abuse of forms and significantly reduce the likelihood of unauthorized access to your application's private features. Soon, CSRF validation will be required for all incoming POST requests to ensure that every form is protected.

Fiddle uses Pocketbase, which implements hashing and salting by default. PocketBase also uses APIs instead of being just a SQL database, which means it's not vulnerable to SQL injection attacks.

#### Content Security Policy
A Content Security Policy (CSP) is also implemented and prevents any stylesheets/scripts from being run on the browser that aren't explicity mentioned within it. If you decide to use external stylesheets/scripts, you'll have to edit the CSP before they'll work. Never use inline scripts as these are disabled. Instead, use an external JS file within the site or hash a script coming from an external domain (this site can help with hashing for you: https://www.srihash.org/). The inconvenience this causes is far outweighed by the security benefits. Having a CSP significantly reduces the risk of XSS attacks and malicious changes to client-side functionality.

Do keep in mind that the CSP is very touchy and difficult to work with. Always thoroughly test before deploying to production.

#### Multi-factor Authentication
Support for 2FA has been added to the admin panel. Users who do not have it enabled will have a button on their home screen to enable it. Fiddle uses time-based one-time passwords for 2FA which can be easily implemented in Google Authenticator. If a user decides to enable 2FA, they'll be prompted to confirm with their password for security and to prevent unintentional enabling. After which, a QR-code will be displayed that a user can use to add the OTP to their preferred OTP-client.

## Roadmap
- [ ] Docker implementation
- [x] Routes
- [x] CSRF Protection
- [ ] Admin Panel (in progress)
    - [ ] Main Dashboard
    - [ ] Template Dashboard
    - [x] User Dashboard
- [x] Maintenance Mode
- [x] Database connection
- [ ] First Stable Release
- [ ] Using database for templates
- [ ] Adding an upload utility
- [x] Detangling code
- [x] Implementing Middleware

## Possible Features
- [ ] YubiKey OTP for Admin Panel
- [ ] Setup Utility
- [ ] OAuth2 Support (very likely)
- [ ] Discord Webhooks Support
- [ ] Integration with Pxls Charity
- [ ] Client-side rendering
- [ ] User Profile Pages
- [x] 2FA Support
