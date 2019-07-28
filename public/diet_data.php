<?php

require_once __DIR__ . '/../bootstrap.php';

$data = $database->query('SELECT * FROM diet ORDER BY day ASC')->fetchAll();

// Construct graph data structure and colour set
$labels = [];
$weights = [];
$circumferences = [];
foreach ($data as $entry) {
    $labels[] = date('c', strtotime($entry['day']));
    $weights[] = $entry['weight'];
    $circumferences[] = $entry['circumference'];
}

echo json_encode(compact('labels', 'weights', 'circumferences'));
