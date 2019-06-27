<?php

require_once __DIR__ . '/bootstrap.php';

// Get API data
$token = getenv('TODOIST_API_TOKEN');
$client = new \GuzzleHttp\Client();
$response = $client->get('https://todoist.com/api/v8/completed/get_stats?token=' . $token);
$data = json_decode((string) $response->getBody());

// Prep the query
$insert = "INSERT OR REPLACE INTO statistics (day, completed) VALUES (:day, :completed)";
$statement = $database->prepare($insert);

// Import all rows
foreach ($data->days_items as $datum) {
    $statement->bindValue(':day', $datum->date, SQLITE3_TEXT);
    $statement->bindValue(':completed', $datum->total_completed, SQLITE3_INTEGER);
    $statement->execute();
}
