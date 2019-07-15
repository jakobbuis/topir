// Self-calling function to poll for new server data
function poll() {
    fetch('/graph_data.php').then(function(response) {
        return response.json();
    }).then(function(json) {
        chart.data.labels = json.labels;
        chart.data.datasets[0].data = json.counts;
        chart.data.datasets[1].data = json.overdue;
        setTimeout(poll, 1000 * 60);
        chart.update(0);
    });
}

// Setup the canvas as full-screen
canvas = document.getElementById('chart');
canvas.width = window.innerWidth;
canvas.height = window.innerHeight / 2;

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
