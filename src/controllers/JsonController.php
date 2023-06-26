<?php

namespace Src\Controllers;

class JsonController
{
    public function index()
    {
        // Load the view
        require_once __DIR__ . '/../resources/storage/data';
    }
}