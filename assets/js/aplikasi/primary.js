// Dashboard Java Script

// Content of Canvas
const chartElement = document.getElementById('myDashboardChart');
const ctx = chartElement.getContext('2d');

// Retrieve Data
const labelData = JSON.parse(chartElement.getAttribute('data-label'));
const valueData = JSON.parse(chartElement.getAttribute('data-value'));

// Define Chart & Set
new Chart(ctx, {
  // Type Plot
  type: 'bar',
  // Define Data on Variable & Color
  data: {
    labels: labelData,
    datasets: [{
      label: 'Jumlah Input',
      data: valueData,
      backgroundColor: [
        'rgba(79, 129, 189, 0.2)',
        'rgba(192, 80, 77, 0.2)',
        'rgba(155, 187, 89, 0.2)'
      ],
      borderColor: [
        'rgba(79, 129, 189, 1)',
        'rgba(192, 80, 77, 1)',
        'rgba(155, 187, 89, 1)',
      ],
      borderWidth: 2
    }]
  },
  // Option
  options: {
    plugins: {
      // Disable Plot Display
      legend: {
        display: false
      }
    },
    // Manipulate Plot Scale
    scales: {
      y: {
        beginAtZero: true,
        ticks: {
          stepSize: 1
        }
      }
    },
    // Config Plot Layout
    layout: {
      padding: {
        left: 20,
        right: 20,
        top: 20,
        bottom: 20
      }
    }
  }
})