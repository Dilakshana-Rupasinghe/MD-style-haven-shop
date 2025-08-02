new Chart(document.getElementById('incomeChart'), {
        type: 'line',
        data: {
            labels: incomeLabels,
            datasets: [{
                label: 'Monthly Income (LKR)',
                data: incomeData,
                backgroundColor: 'rgba(54, 162, 235, 0.6)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true,
                    title: {
                        display: true,
                        text: 'Income (LKR)'
                    }
                },
                x: {
                    title: {
                        display: true,
                        text: 'Month'
                    }
                }
            },
            plugins: {
                title: {
                    display: true,
                    text: 'Monthly Income Chart'
                }
            }
        }
    });