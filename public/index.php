<?php

require __DIR__ . '/../vendor/autoload.php';

$database = new PDO('sqlite:../statistics');
$database->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$data = $database->query('SELECT * FROM statistics ORDER BY day ASC')->fetchAll();

// Construct graph data structure and colour set
$labels = [];
$counts = [];
$colours = [];
foreach ($data as $entry) {
    $labels[] = date('d-m', strtotime($entry['day']));
    $counts[] = $entry['completed'];
    $colours[] = $entry['completed'] >= 8 ? '#3cba9f' : '#c45850';
}

?><!DOCTYPE html>
<html>
<head>
    <title>Todoist statistics</title>
</head>
<body>

    <canvas id="chart" width="400" height="400"></canvas>

    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0/dist/Chart.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@0.6.0/dist/chartjs-plugin-datalabels.min.js"></script>

    <script>
        // Setup the canvas as full-screen
        canvas = document.getElementById('chart');
        canvas.width = document.body.clientWidth;
        canvas.height = document.body.clientHeight;

        // Bar chart
        new Chart(canvas, {
            type: 'bar',
            data: {
                labels: <?= json_encode($labels) ?>,
                datasets: [
                    {
                        backgroundColor: <?= json_encode($colours) ?>,
                        data: <?= json_encode($counts) ?>,
                    }
                ]
            },
            options: {
                legend: { display: false },
                title: {
                    display: true,
                    text: 'Number of completed tasks, per day',
                },
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                },
                plugins: {
                    datalabels: {
                        anchor: 'start',
                        align: 'top',
                    },
                },
            }
        });
    </script>
</body>
</html>
