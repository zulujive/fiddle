#!/usr/bin/env php
<?php

$command = 'php -S localhost:7890 public/index.php';
$outputLines = [];
exec($command, $outputLines);

