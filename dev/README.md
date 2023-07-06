# Developer Documentation

Here you can find more detailed developer documentation and help. You can find proper workflows for creating pages and following formatting rules to keep the source looking clean and structured.

## Routing

Fiddle uses the Bramus routing library. You can find the routes in the "web" folder within the "src" folder. Generally, be as object-oriented as possible by using controllers to load views and keep views organized within their respective classes. Put views in their respective folder as well.
When deciding between creating a view or creating a method, consider its use. If it includes client-side functionality, especially an interface, then create a view. If this is more for backend scripting, create a class instead.

## Dependencies

When using dependencies, use well-supported, stable and tested packages. Avoid using dependencies with repositories that are rarely updated, regardless of their functionality and popularity. Security vulnerabilities in dependencies is a major cause of security failures, prevent them by using solid dependencies.

## Pull Requests and Merges

When making a pull request, double check your code and test every feature related to it. Pull requests are generally considered for merging when they've been thoroughly tested, have a case for addition to the codebase and are well-written. Pull requests that have unreliable, very buggy and many security vulnerabilities will be closed.
