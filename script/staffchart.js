var ctx = document.getElementById('pieChart').getContext('2d');
var myChart = new Chart(ctx, {
    type: 'pie', // Type of chart (bar, line, pie, etc.)
    data: {
        labels: staffLabels, //use json array (staff_type_name)
        datasets: [{
            label: 'Emplolye',
            data: staffData, // Data for the graph
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(99, 255, 132, 0.2)'
            ],
            borderColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
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

