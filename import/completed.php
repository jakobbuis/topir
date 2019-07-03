<?php

require_once __DIR__ . '/../bootstrap.php';

// Get API data
$token = getenv('TODOIST_API_TOKEN');
$client = new \GuzzleHttp\Client();
$response = $client->get('https://todoist.com/api/v8/completed/get_stats?token=' . $token);
$data = json_decode((string) $response->getBody());

// Prep the queries
$count = $database->prepare('SELECT COUNT(*) FROM statistics WHERE day = :day');
$insert = $database->prepare('INSERT INTO statistics (day, completed) VALUES (:day, :completed)');
$update = $database->prepare('UPDATE statistics SET completed = :completed WHERE day = :day');

// Import all rows
foreach ($data->days_items as $datum) {
    // Check for an existing row
    $count->execute([':day' => $datum->date]);
    if ($count->fetchColumn() == 0) {
        $insert->execute([':day' => $datum->date, ':completed' => $datum->total_completed]);
    } else {
        $update->execute([':day' => $datum->date, ':completed' => $datum->total_completed]);
    }
}
