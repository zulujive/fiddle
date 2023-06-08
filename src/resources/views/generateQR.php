<?php
use Endroid\QrCode\QrCode;
use OTPHP\TOTP;

$otp = TOTP::create();
$otpURI = 'otpauth://totp/PxlsFiddle?secret=' . $otp->getSecret() . '';

// Create a new QRCode instance
$qrCode = new QrCode($OTPURI);

// Set the size of the QR code
$qrCode->setSize(300);

// Set the foreground and background colors
$qrCode->setForegroundColor(['r' => 0, 'g' => 0, 'b' => 0]);
$qrCode->setBackgroundColor(['r' => 255, 'g' => 255, 'b' => 255]);

// Output the QR code image
header('Content-Type: '.$qrCode->getContentType());
echo $qrCode->writeString();
