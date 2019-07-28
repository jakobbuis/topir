// Setup the canvas as full-screen
dietElement = document.getElementById('diet');
dietElement.style.width = '100%';
dietElement.style.height = '100%';
dietElement.width = dietElement.offsetWidth;
dietElement.height = dietElement.offsetHeight;

// Bar chart
const red = 'rgb(255, 99, 132)';
const blue = 'rgb(54, 162, 235)';

var dietChart = new Chart(dietElement, {
    type: 'line',
    data: {
        labels: [],
        datasets: [
            { label: 'Weight', data: [], backgroundColor: red, borderColor: red, fill: false },
            { label: 'Circumference', data: [], backgroundColor: blue, borderColor: blue, fill: false },
        ]
    },
    options: {
        scales: {
            xAxes: [{
                type: 'time',
               time: {
                    unit: 'day',
                },
            }],
            yAxes: [{
                ticks: {
                    min: 80,
                    max: 100,
                },
            }],
        },
        legend: { display: true },
        plugins: {
            datalabels: {
                anchor: 'start',
                align: 'top',
            },
        },
    }
});

// Get data from endpoint
fetch('/diet_data.php').then(function(response) {
    return response.json();
}).then(function(json) {
    dietChart.data.labels = json.labels;
    dietChart.data.datasets[0].data = json.weights;
    dietChart.data.datasets[1].data = json.circumferences;
    dietChart.update(0);
});

// Form input
document.getElementById('setDiet').addEventListener('click', function (event) {
    // construct data set
    var weight = prompt('Weight?');
    var circumference = prompt('Circumference?');
    if (!weight || !circumference) {
        return;
    }
    var today = new Date();

    // add new data point to graph
    dietChart.data.labels.push(`${today.getDate()}-${today.getMonth()+1}`);
    dietChart.data.datasets[0].data.push(weight);
    dietChart.data.datasets[1].data.push(circumference);
    dietChart.update(0);

    // store data point on server
    var request = new XMLHttpRequest();
    var query = `day=${today.toISOString()}&weight=${weight}&circumference=${circumference}`
    request.open('POST', `/diet_update.php?${query}`, true);
    request.send();
});
