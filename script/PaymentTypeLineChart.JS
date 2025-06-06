var ctx = document.getElementById('LineChart').getContext('2d');
var myChart = new Chart(ctx, {
    type: 'line', // Type of chart (bar, line, pie, etc.)
    data: {
        labels:  $payment_type_labels, // X-axis labels
        datasets: [{
            label: 'Payment Type Data By complete order',
            data: $payment_type_data, // Data for the graph
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