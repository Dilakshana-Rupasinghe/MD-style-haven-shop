var ctx = document.getElementById('myChart').getContext('2d');
var myChart = new Chart(ctx, {
    type: 'bar', // Type of chart (bar, line, pie, etc.)
    data: {
        labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'October', 'December'], // X-axis labels
        datasets: [{
            label: 'Sales Data',
            data: [1200, 1900, 300, 2500, 200, 300, 500, 1000, 600, 650, 550, 2850], // Data for the graph
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(255, 159, 64, 0.2)',
                'rgba(270, 75, 84, 0.2)',
                'rgba(280, 190, 70, 0.2)',
                'rgba(155, 129, 150, 0.2)',
                'rgba(210, 289, 110, 0.2)',
                'rgba(0, 259, 125, 0.2)',
                'rgba(99, 255, 132, 0.2)'
            ],
            borderColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)',
                'rgba(270, 75, 84, 1)',
                'rgba(280, 190, 70, 1)',
                'rgba(155, 129, 150, 1)',
                'rgba(210, 289, 110, 1)',
                'rgba(0, 259, 125, 1)',
                'rgba(99, 255, 132, 1)'
            ],
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            y: {
                beginAtZero: true
            }
        }
    }
});