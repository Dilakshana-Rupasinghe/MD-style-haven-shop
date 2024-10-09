var ctx = document.getElementById('lineChart').getContext('2d');
var myChart = new Chart(ctx, {
    type: 'line', // Type of chart (bar, line, pie, etc.)
    data: {
        labels: ['Ja', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sept', 'Oct', 'Nov', 'Dec'], // X-axis labels
        datasets: [{
            label: 'Stroke Data',
            data: [400, 350, 390, 540, 400, 350, 360, 410, 370, 0, 0, 0], // Data for the graph
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)'
         
            ],
            borderColor: [
                'rgba(255, 99, 132, 1)'
                
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