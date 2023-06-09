<?php
use Endroid\QrCode\Color\Color;
use Endroid\QrCode\Encoding\Encoding;
use Endroid\QrCode\ErrorCorrectionLevel\ErrorCorrectionLevelLow;
use Endroid\QrCode\QrCode;
use Endroid\QrCode\RoundBlockSizeMode\RoundBlockSizeModeMargin;
use Endroid\QrCode\Writer\PngWriter;
use GuzzleHttp\Client;
require_once __DIR__ . '/../../../config.php';
require_once __DIR__ . '/../methods/tokenHandler.php';

$tokenValid = tokenHandler::verifyToken($_GET['token'], $_SESSION["userID"]);

if (isset($_GET['id'])) {
    $id = $_GET['id'];
} else {
    echo "You must define URL parameters";
    exit();
}
if ($id !== $_SESSION["userID"])
{
    echo "Error: Unauthorized";
    exit();
}
if ($tokenValid !== true)
{
    echo "Invalid API Token";
    exit();
}

$client = new Client(['defaults' => [ 'exceptions' => false ]] );

$response = $client->get('' . DB_HOST . '/api/collections/admins/records/' . $id . '');
$responseData = json_decode($response->getBody(), true);
$secret = $responseData['2FASecret'];
if (!isset($secret))
{
    echo "Account does not have 2FA";
    exit();
}

$writer = new PngWriter();

$OTPURI = 'otpauth://totp/PxlsFiddle?secret=' . $secret . '';

$qrCode = QrCode::create($OTPURI)
    ->setEncoding(new Encoding('UTF-8'))
    ->setErrorCorrectionLevel(new ErrorCorrectionLevelLow())
    ->setSize(300)
    ->setMargin(10)
    ->setRoundBlockSizeMode(new RoundBlockSizeModeMargin())
    ->setForegroundColor(new Color(0, 0, 0))
    ->setBackgroundColor(new Color(255, 255, 255));

$result = $writer->write($qrCode);

// Output the QR code image
header('Content-Type: '.$result->getMimeType());
echo $result->getString();

tokenHandler::disableToken($_GET['token']);