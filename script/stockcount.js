var ctx = document.getElementById('bar-chart').getContext('2d');
var myChart = new Chart(ctx, {
    type: 'bar', // Type of chart (bar, line, pie, etc.)
    data: {
        labels: item_labels, // X-axis labels
        datasets: [{
            label: 'Product',
            data: item_data, // Data for the graph
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(9, 27, 85, 0.2)',
                'rgba(134, 64, 70, 0.2)',
                'rgba(61, 54, 53, 0.2)',
                'rgba(70, 3, 255, 0.46)'
            ],
            borderColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgb(209, 92, 211)',
                'rgb(197, 78, 41)',
                'rgb(14, 69, 71)',
                'rgba(99, 255, 132, 1)'
            ],
            borderWidth: 1
        }]
    },
    options: {
        responsive: true, // Make the chart responsive
        scales: {
            y: {
                beginAtZero: true // Start the y-axis at zero
            }
        }
    }
});