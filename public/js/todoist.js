// Self-calling function to poll for new server data
function poll() {
    fetch('/graph_data.php').then(function(response) {
        return response.json();
    }).then(function(json) {
        todoistChart.data.labels = json.labels;
        todoistChart.data.datasets[0].data = json.counts;
        todoistChart.data.datasets[1].data = json.overdue;
        setTimeout(poll, 1000 * 60);
        todoistChart.update(0);
    });
}

// Setup the canvas as full-screen
todoistElement = document.getElementById('todoist');
todoistElement.style.width = '100%';
todoistElement.style.height = '100%';
todoistElement.width = todoistElement.offsetWidth;
todoistElement.height = todoistElement.offsetHeight;

// Bar chart
var todoistChart = new Chart(todoistElement, {
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
