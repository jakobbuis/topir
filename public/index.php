<?php

require __DIR__ . '/../vendor/autoload.php';

$database = new PDO('sqlite:../statistics');
$database->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$data = $database->query('SELECT * FROM statistics ORDER BY day ASC')->fetchAll();

$graph = array_map(function($entry) {
    return (object) [
        'x' => $entry['day'],
        'y' => (int) $entry['completed'],
    ];
}, $data);

?><!DOCTYPE html>
<html>
<head>
    <title>Todoist statistics</title>
</head>
<body>

    <canvas id="chart" width="400" height="400"></canvas>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.bundle.min.js"></script>
    <script>
        new Chart(document.getElementById('chart').getContext('2d'), {
            type: 'bar',
            data: <?= json_encode($graph); ?>,
            options: {
                scales: {
                    xAxes: [{
                        barPercentage: 0.5,
                        barThickness: 6,
                        maxBarThickness: 8,
                        minBarLength: 2,
                        gridLines: {
                            offsetGridLines: true
                        }
                    }]
                }
            }
        });

    </script>
</body>
</html>
