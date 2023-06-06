<?php

// Make sure to include the HTTP client library you prefer to use
// For example, Guzzle is a popular HTTP client for PHP

// Make a POST request to the authentication endpoint
$client = new GuzzleHttp\Client();
$response = $client->post('http://127.0.0.1:8090/auth', [
    'json' => [
        'username' => 'test',
        'password' => '12345678',
    ]
]);

// Check the response status code
if ($response->getStatusCode() === 200) {
    echo "Authentication successful";
} else {
    echo "Authentication failed";
}
