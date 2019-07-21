// Self-calling function to poll for new server data
function poll() {
    fetch('/graph_data.php').then(function(response) {
        return response.json();
    }).then(function(json) {
        todoist.data.labels = json.labels;
        todoist.data.datasets[0].data = json.counts;
        todoist.data.datasets[1].data = json.overdue;
        setTimeout(poll, 1000 * 60);
        todoist.update(0);
    });
}

// Setup the canvas as full-screen
canvas = document.getElementById('todoist');
canvas.width = window.innerWidth;
canvas.height = window.innerHeight / 2;

// Bar chart
var todoist = new Chart(canvas, {
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
