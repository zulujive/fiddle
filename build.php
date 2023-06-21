<?php
$pharFile = 'fiddle.phar';
$mainScript = 'public/index.php';

$phar = new Phar($pharFile);
$phar->startBuffering();

// Add files and directories to the Phar archive
$phar->buildFromDirectory(__DIR__, '/^(?!(build\.php)).+/');

// Set the main script for execution when the Phar is run
$phar->setStub($phar->createDefaultStub($mainScript));

$phar->stopBuffering();

echo "Phar file created successfully: $pharFile\n";
