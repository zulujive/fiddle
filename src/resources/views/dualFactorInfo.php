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
                'password' => $password,
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
            $secret = $otp->getSecret();
            try {
            $patchResponse = $client->patch('http://127.0.0.1:8090/api/collections/admins/records/' . $userID . '', [
                'json' => [
                    '2FA' => true,
                    '2FASecret' => $secret,
                ]
            ]);
            if ($patchResponse->getStatusCode() === 200) {
                $_SESSION["2FA"] = true;
            }
            } catch (GuzzleHttp\Exception\ClientException $e) {
                $error_message = "Something went wrong on our end";
                echo $error_message;
                exit();
            }
        }
    } catch (GuzzleHttp\Exception\ClientException $e) {
        $error_message = "Invalid password";
        echo $error_message;
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>2FA Info</title>
</head>
<body>
    <div class="container card bg-primary text-white shadow" style="width:40%">
        <h3>Your 2FA Info</h3>
        <p>
            DO NOT reload the page, as this data will not be repeated.<br>
            Please go to your authenticator app and scan the QR Code below. 
            This will be where your one-time passcodes generate.
        </p>
        <img src="http://localhost:8080/qrcode?secret=<?php echo $secret ?>">
    </div>
</body>
</html>