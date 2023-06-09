<?php
use GuzzleHttp\Client;
use OTPHP\TOTP;
require_once __DIR__ . '/../../../config.php';
require_once __DIR__ . '/../methods/Csrf.php';
require_once __DIR__ . '/../methods/tokenHandler.php';

if (isset($_POST['password']))
{
    Csrf::verifyToken();
    $username = $_SESSION["username"];
    $password = $_POST['password'];
    $userID = $_SESSION["userID"];

    $client = new Client(['defaults' => [ 'exceptions' => false ]] );
    $token = tokenHandler::createToken(qrCode, true, $userID);

    try {
        $response = $client->post('' . DB_HOST . '/api/collections/admins/auth-with-password', [
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
            $patchResponse = $client->patch('' . DB_HOST . '/api/collections/admins/records/' . $userID . '', [
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

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">

</head>
<body class="m-4">
    <div class="container card bg-primary text-white shadow p-3" style="width:40%">
        <h3 class="text-center">Your 2FA Info</h3>
        <p class="text-center">
            DO NOT reload the page, as this data will not be repeated.<br>
            Please go to your authenticator app and scan the QR Code below. 
            This will be where your one-time passcodes generate.
        </p>
        <div class="mb-2" style="text-align:center">
            <img src="/qrcode?id=<?php echo $userID ?>&token=<?php echo $token ?>" width="50%"><br>
        </div>
        <p>If the image doesn't load, your secret is:<br>
        <b><?php echo $secret ?></b></p>
        <a class="btn btn-outline-light" href="/admin">Done</a>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</body>
</html>