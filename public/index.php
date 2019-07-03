<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">

    <title>Todoist statistics</title>
</head>
<body>

    <canvas id="chart" width="400" height="400"></canvas>

    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0/dist/Chart.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@0.6.0/dist/chartjs-plugin-datalabels.min.js"></script>

    <script>
        // Self-calling function to poll for new server data
        function poll() {
            fetch('/graph_data.php').then(function(response) {
                return response.json();
            }).then(function(json) {
                chart.data.labels = json.labels;
                chart.data.datasets[0].data = json.counts;
                setTimeout(poll, 1000 * 60);
                chart.update(0);
            });
        }

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
                {
                    backgroundColor: '#3cba9f',
                    data: [],
                }
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
