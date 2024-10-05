var ctx = document.getElementById('barChart').getContext('2d');
var myChart = new Chart(ctx, {
    type: 'bar', // Type of chart (bar, line, pie, etc.)
    data: {
        labels: ['Ja', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sept', 'Oct', 'Nov', 'Dec'], // X-axis labels
        datasets: [{
            label: 'Sales Data',
            data: [1200, 1900, 300, 2500, 200, 300, 500, 1000, 600, 0, 0, 0], // Data for the graph
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