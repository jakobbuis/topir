<?php

require_once __DIR__ . '/bootstrap.php';

return [
    'dbname' => getenv('DB_NAME'),
    'user' => getenv('DB_USER'),
    'password' => getenv('DB_PASSWORD'),
    'host' => 'localhost',
    'driver' => 'pdo_mysql',
];
