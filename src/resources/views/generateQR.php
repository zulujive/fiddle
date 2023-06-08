<?php
use Endroid\QrCode\QrCode;
use OTPHP\TOTP;

$otp = TOTP::create();
$OTPURI = 'otpauth://totp/PxlsFiddle?secret=' . $otp->getSecret() . '';

$qrCode = QrCode::create($OTPURI)
    ->setEncoding(new Encoding('UTF-8'))
    ->setErrorCorrectionLevel(new ErrorCorrectionLevelLow())
    ->setSize(300)
    ->setMargin(10)
    ->setRoundBlockSizeMode(new RoundBlockSizeModeMargin())
    ->setForegroundColor(new Color(0, 0, 0))
    ->setBackgroundColor(new Color(255, 255, 255));

// Output the QR code image
header('Content-Type: '.$qrCode->getContentType());
echo $qrCode->writeString();
