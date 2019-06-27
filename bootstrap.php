<?php

require __DIR__ . '/vendor/autoload.php';

// Setup environment
$dotenv = Dotenv\Dotenv::create(__DIR__);
$dotenv->load();

// Open database
$database = new PDO('sqlite:' . __DIR__ . '/statistics');
$database->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
