<?php
$pharFile = 'fiddle.phar';
$mainScript = 'public/index.php';

$phar = new Phar($pharFile);
$phar->startBuffering();

// Add PHP files
$phar->buildFromDirectory(__DIR__, '/^(?!(build\.php)).+\.(php|inc)$/');

// Add non-PHP files from directories
$directories = [
    'src/storage/templates',
    'src/resources/css',
    'src/resources/js',
];

foreach ($directories as $directory) {
    $iterator = new RecursiveIteratorIterator(
        new RecursiveDirectoryIterator($directory),
        RecursiveIteratorIterator::SELF_FIRST
    );
    foreach ($iterator as $file) {
        if ($file->isFile() && !$file->isDir()) {
            $relativePath = substr($file->getPathname(), strlen($directory) + 1);
            $phar->addFile($file->getPathname(), $relativePath);
        }
    }
}

// Set the main script for execution when the Phar is run
$phar->setStub("#!/usr/bin/env php\n" . $phar->createDefaultStub($mainScript));

$phar->stopBuffering();

echo "Phar file created successfully: $pharFile\n";
