<?php
require __DIR__ . '/../methods/PocketBase.php';

$imageTestUrl = PocketBase::getTemplateUrl('wrhjuujj7dwoe3x');
$imageResponse = $client->get($imageTestUrl);
$imageData = $imageResponse->getBody()->getContents();

// Set the appropriate content-type header for the image
header('Content-Type: ' . $response->getHeaderLine('Content-Type'));

echo $imageData;