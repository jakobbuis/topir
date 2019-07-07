<?php

require_once __DIR__ . '/../bootstrap.php';

// Get API data
$token = getenv('TODOIST_API_TOKEN');
$client = new \GuzzleHttp\Client();
$response = $client->get('https://api.todoist.com/rest/v1/tasks?filter=overdue&token=' . $token);
$data = json_decode((string) $response->getBody());
$overdueCount = count($data);

// Prep the queries
$count = $database->prepare('SELECT COUNT(*) FROM statistics WHERE day = :day');
$insert = $database->prepare('INSERT INTO statistics (day, overdue) VALUES (:day, :overdue)');
$update = $database->prepare('UPDATE statistics SET overdue = :overdue WHERE day = :day');

// Check for an existing row
$yesterday = date('Y-m-d', strtotime('yesterday'));
$count->execute([':day' => $yesterday]);
if ($count->fetchColumn() == 0) {
    $insert->execute([':day' => $yesterday, ':overdue' => $overdueCount]);
} else {
    $update->execute([':day' => $yesterday, ':overdue' => $overdueCount]);
}
