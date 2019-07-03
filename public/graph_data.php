<?php

require_once __DIR__ . '/../bootstrap.php';

$data = $database->query('SELECT * FROM statistics ORDER BY day ASC LIMIT 30')->fetchAll();

// Construct graph data structure and colour set
$labels = [];
$counts = [];
$colours = [];
foreach ($data as $entry) {
    $labels[] = date('d-m', strtotime($entry['day']));
    $counts[] = $entry['completed'];
    $colours[] = $entry['completed'] >= 8 ? '#3cba9f' : '#c45850';
}

echo json_encode(compact('labels', 'counts', 'colours'));
