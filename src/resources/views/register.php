<?php
use GuzzleHttp\Client;
require_once __DIR__ . '/../methods/Csrf.php';
require_once __DIR__ . '/../../../config.php';

if (isset($_POST["username"]) && isset($_POST["password"])) {
    Csrf::verifyToken();
    $username_unsanitized = $_POST["username"];
    $password_unsanitized = $_POST["password"];
    $password_confirm_unsanitized = $_POST["passwordConfirm"];

  	$username = filter_var($username_unsanitized, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
    $password = filter_var($password_unsanitized, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
    $passwordConfirm = filter_var($password_confirm_unsanitized, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);

    $hashedPassword = $password;
    $hashedPasswordConfirm = password_hash($passwordConfirm, PASSWORD_DEFAULT);

    $client = new Client(['defaults' => [ 'exceptions' => false ]] );

    try {
        $response = $client->post('' . DB_HOST . '/api/collections/admins/records', [
            'json' => [
                'username' => $username,
                'password' => $hashedPassword,
                'passwordConfirm' => $hashedPassword,
                'isAdmin' => false
            ],
            'headers' => [
                'pb_token' => DB_KEY,
            ]
        ], ['http_errors' => false]);
        if ($response->getStatusCode() === 200) {
            $_SESSION["registration_success"] = true;
            header("Location: /admin/users");
            exit();
        }
    } catch (GuzzleHttp\Exception\ClientException $e) {
        $error_message = "Could not create user";
    }
}