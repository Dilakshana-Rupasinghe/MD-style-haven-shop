var ctx = document.getElementById('paymentTypeBarchart').getContext('2d');
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
            scales: {
                y: {
                    beginAtZero: true,
                    title: {
                        display: true,
                        text: 'Total count'
                    }
                },
                x: {
                    title: {
                        display: true,
                        text: 'Payment type'
                    }
                }
            },
            plugins: {
                title: {
                    display: true,
                }
            }
        }
});

