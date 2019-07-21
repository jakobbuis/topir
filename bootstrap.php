<?php

require __DIR__ . '/vendor/autoload.php';

// Setup environment
$dotenv = Dotenv\Dotenv::create(__DIR__);
$dotenv->load();

// Open database
$user = getenv('DB_USER');
$name = getenv('DB_NAME');
$pass = getenv('DB_PASSWORD');
$dsn = "mysql:host=localhost;dbname={$name};charset=utf8mb4";
$database = new PDO($dsn, $user, $pass);
$database->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
