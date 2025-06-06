var ctx = document.getElementById('lineChart').getContext('2d');
var mychart = new Chart(ctx, {
    type: 'bar', // Type of chart (bar, line, pie, etc.)
    data: {
        labels:  Payment_Type_labels, // X-axis labels
        datasets: [{
            label: 'Payment Type Data By complete order',
            data: Payment_Type_data, // Data for the graph
           
            borderWidth: 3
        }]
    },
     options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'top'
                }
            }
        }
});

