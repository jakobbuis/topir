<?php

require __DIR__ . '/../vendor/autoload.php';

$database = new PDO('sqlite:../statistics');
$database->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$data = $database->query('SELECT * FROM statistics ORDER BY day ASC')->fetchAll();

// Construct graph data structure
$labels = [];
$counts = [];
foreach ($data as $entry) {
    $labels[] = date('d-m', strtotime($entry['day']));
    $counts[] = (int) $entry['completed'];
}

?><!DOCTYPE html>
<html>
<head>
    <title>Todoist statistics</title>
</head>
<body>

    <canvas id="chart" width="400" height="400"></canvas>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.bundle.min.js"></script>
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
                        backgroundColor: "#3cba9f",
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
                }
            }
        });
    </script>
</body>
</html>
