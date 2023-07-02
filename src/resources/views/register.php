<?php
use GuzzleHttp\Client;
require_once __DIR__ . '/../methods/Csrf.php';

if (isset($_POST["username"]) && isset($_POST["password"])) {
    Csrf::verifyToken();
    $username_unsanitized = $_POST["username"];
    $password_unsanitized = $_POST["password"];
    $password_confirm_unsanitized = $_POST["passwordConfirm"];

    // Sanitize inputs!
  	$username = htmlspecialchars($username_unsanitized, FILTER_FLAG_NO_ENCODE_QUOTES);
    $password = htmlspecialchars($password_unsanitized, FILTER_FLAG_NO_ENCODE_QUOTES);
    $passwordConfirm = htmlspecialchars($password_confirm_unsanitized, FILTER_FLAG_NO_ENCODE_QUOTES);

    $client = new Client(['defaults' => [ 'exceptions' => false ]] );

    try {
        $response = $client->post('' . config('DB_HOST') . '/api/collections/admins/records', [
            'json' => [
                'username' => $username,
                'password' => $password,
                'passwordConfirm' => $passwordConfirm,
                'isAdmin' => false
            ],
            'headers' => [
                'pb_token' => config('DB_KEY'),
            ]
        ], ['http_errors' => false]);
        if ($response->getStatusCode() === 200) {
            $_SESSION["registration_success"] = true;
            header("Location: /admin/users");
            exit();
        }
    // Handle an HTTP error if registration has failed
    } catch (GuzzleHttp\Exception\ClientException $e) {
        $error_message = "Could not create user";
    }
}