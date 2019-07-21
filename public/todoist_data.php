<?php

require_once __DIR__ . '/../bootstrap.php';

$data = $database->query('SELECT * FROM (SELECT * FROM statistics ORDER BY day DESC limit 28) AS sdd ORDER BY day ASC')->fetchAll();

// Construct graph data structure and colour set
$labels = [];
$counts = [];
$overdue = [];
$dateKeys = [
    1 => 'Mo',
    2 => 'Tu',
    3 => 'We',
    4 => 'Th',
    5 => 'Fr',
    6 => 'Sa',
    7 => 'Su',
];
foreach ($data as $entry) {
    $labels[] = $dateKeys[date('N', strtotime($entry['day']))];
    $counts[] = $entry['completed'];
    $overdue[] = $entry['overdue'];
}

echo json_encode(compact('labels', 'counts', 'overdue'));
