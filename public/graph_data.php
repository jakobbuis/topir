<?php

require_once __DIR__ . '/../bootstrap.php';

$data = $database->query('SELECT * FROM statistics ORDER BY day ASC LIMIT 30')->fetchAll();

// Construct graph data structure and colour set
$labels = [];
$counts = [];
$overdue = [];
foreach ($data as $entry) {
    $labels[] = date('d-m', strtotime($entry['day']));
    $counts[] = $entry['completed'];
    $overdue[] = $entry['overdue'];
}

echo json_encode(compact('labels', 'counts', 'overdue'));
