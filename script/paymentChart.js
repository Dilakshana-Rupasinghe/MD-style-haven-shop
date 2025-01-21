// <block:setup:1>
const labels1 = orderLabels; // Use paymenth meothd names as labels
const data1 = {
  labels: labels1,
  datasets: [{
    label: `order`,
    data: orderData, // Use order data as the chart's dataset
    backgroundColor: [
      'rgba(153, 102, 255, 0.2)',
      'rgba(75, 192, 192, 0.2)'
    ],

    borderColor: [
      'rgb(153, 102, 255)',
      'rgb(75, 192, 192)'
    ],

    borderWidth: 1
  }]
};
// </block:setup>

// <block:config:0>
const config1 = {
  type: 'bar',
  data: data1,
  options: {
    scales: {
      y: {
        beginAtZero: true
      }
    }
  },
};
// </block:config>

// Create the chart after the config is defined
var ctx1 = document.getElementById('barChart1').getContext('2d');
var myChart1 = new Chart(ctx1, config1);
