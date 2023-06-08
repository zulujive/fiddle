<?php
use GuzzleHttp\Client;
use OTPHP\TOTP;

if (isset($_POST['password']))
{
    $username = $_SESSION["username"];
    $password = $_POST['password'];
    $userID = $_SESSION["userID"];

    try {
        $response = $client->post('http://127.0.0.1:8090/api/collections/admins/auth-with-password', [
            'json' => [
                'identity' => $username,
                'password' => $hashedPassword,
            ]
        ], ['http_errors' => false]);
        if ($response->getStatusCode() === 200) {
            $responseData = json_decode($response->getBody(), true);
            $record = $responseData['record'];
            if ($record['2FA'] == true) {
                // Ensure that the user doesn't already have 2FA enabled
                echo "2FA is already enabled for this account";
                exit();
            }
            $otp = TOTP::create();
            
            $_SESSION["2FA"] = true;
            exit();
        }
    } catch (GuzzleHttp\Exception\ClientException $e) {
        $error_message = "Invalid username and/or password";
        echo $error_message;
        exit();
    }
}