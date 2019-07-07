<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Todoist statistics</title>

    <style>
        footer {
            position: absolute;
            box-sizing: border-box;
            bottom: 0;
            left: 0;
            background-color: #666;
            width: 100%;
            padding: 1em;
            color: white;
        }
    </style>
</head>
<body>

    <canvas id="chart" width="400" height="400"></canvas>

    <footer>
        <button id=fullscreen>Fullscreen</button>
        <button id="refresh">Refresh now</button>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0/dist/Chart.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@0.6.0/dist/chartjs-plugin-datalabels.min.js"></script>

    <script>
        window.pollTimeout = null;
        // Self-calling function to poll for new server data
        function poll() {
            fetch('/graph_data.php').then(function(response) {
                return response.json();
            }).then(function(json) {
                chart.data.labels = json.labels;
                chart.data.datasets[0].data = json.counts;
                chart.data.datasets[1].data = json.overdue;
                window.pollTimeout = setTimeout(poll, 1000 * 60);
                chart.update(0);
            });
        }

        document.getElementById('fullscreen').addEventListener('click', function(event) {
            document.documentElement.requestFullscreen();
        });

        document.getElementById('refresh').addEventListener('click', function(event) {
            clearTimeout(window.pollTimeout);
            poll();
        });

        // Setup the canvas as full-screen
        canvas = document.getElementById('chart');
        canvas.width = document.body.clientWidth;
        canvas.height = document.body.clientHeight;

        // Bar chart
        var chart = new Chart(canvas, {
            type: 'bar',
            data: {
                labels: [],
                datasets: [
                    { backgroundColor: '#3cba9f', data: [] },
                    { backgroundColor: '#c45850', data: [] },
                ]
            },
            options: {
                legend: { display: false },
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

        poll();
    </script>
</body>
</html>
