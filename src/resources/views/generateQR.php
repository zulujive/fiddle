<?php
use Endroid\QrCode\Color\Color;
use Endroid\QrCode\Encoding\Encoding;
use Endroid\QrCode\ErrorCorrectionLevel\ErrorCorrectionLevelLow;
use Endroid\QrCode\QrCode;
use Endroid\QrCode\Label\Label;
use Endroid\QrCode\Logo\Logo;
use Endroid\QrCode\RoundBlockSizeMode\RoundBlockSizeModeMargin;
use Endroid\QrCode\Writer\PngWriter;
use Endroid\QrCode\Writer\ValidationException;
use OTPHP\TOTP;

if (isset($_GET['secret'])) {
    // Access the value of the 'id' parameter
    $secret = $_GET['secret'];
} else {
    echo "You must define URL parameters";
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