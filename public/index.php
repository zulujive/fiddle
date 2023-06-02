<?php

spl_autoload_register(function ($className) {
    require_once __DIR__ . '/../src/controllers/' . $className . '.php';
});

$route = $_GET['route'] ?? '';

switch ($route) {
    case '':
    case '/':
        $controller = new HomeController();
        $controller->index();
        break;
    case '/style':
        $cssFilePath = __DIR__ . '/css/style.css';
        if (file_exists($cssFilePath)) {
            header('Content-Type: text/css');
            readfile($cssFilePath);
        } else {
            http_response_code(404);
            echo '404 Not Found';
        }
        break;

    case '/json':
        $controller = new JsonController();
        $controller->index();
        break;
    
// ---------------------------
    default:
        // Handle 404 Not Found
        http_response_code(404);
        echo '404 Not Found';
        break;
}