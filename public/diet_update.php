<?php

require_once __DIR__ . '/../bootstrap.php';

// Process input
$date = date('Y-m-d', strtotime($_GET['day']));
$weight = number_format((float) $_GET['weight'], 1);
$circumference = number_format((float) $_GET['circumference'], 1);

// Create record
$database
    ->prepare('INSERT INTO `diet` (day, weight, circumference) VALUES (:day, :weight, :circumference)')
    ->execute([
        ':day' => $date,
        ':weight' => $weight,
        ':circumference' => $circumference,
    ]);

http_response_code(204);
