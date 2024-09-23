document.addEventListener("DOMContentLoaded", function() {
    const ctx = document.getElementById('barChart').getContext('2d');

    // Get the data from the HTML (data attributes)
    const labels = JSON.parse(document.getElementById('barChart').dataset.labels);
    const maleData = JSON.parse(document.getElementById('barChart').dataset.maleData);
    const femaleData = JSON.parse(document.getElementById('barChart').dataset.femaleData);

    const data = {
        labels: labels,
        datasets: [
            {
                label: 'Male',
                data: maleData, // Data for males
                backgroundColor: '#0000FF', // Blue color for males
                borderWidth: 0,
                borderRadius: 50, // Rounded corners
                borderSkipped: false
            },
            {
                label: 'Female',
                data: femaleData, // Data for females
                backgroundColor: '#FFD700', // Yellow color for females
                borderWidth: 0,
                borderRadius: 50, // Rounded corners
                borderSkipped: false
            }
        ]
    };

    const config = {
        type: 'bar',
        data: data,
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'top',
                    labels: {
                        color: '#000', // Legend text color
                    }
                },
                title: {
                    display: true,
                    text: 'Karyawan Per Jabatan',
                    font: {
                        size: 20
                    }
                },
                subtitle: {
                    display: true,
                    text: 'Total karyawan tiap Jabatan'
                }
            },
            scales: {
                x: {
                    grid: {
                        display: false, // Remove grid on X axis
                    },
                    ticks: {
                        color: '#000', // X axis label color
                    },
                    stacked: false,
                    barThickness: 50, // Bar width
                    maxBarThickness: 60, // Max bar width
                    categoryPercentage: 0.6, // Adjust bar width percentage
                    barPercentage: 0.9 // Space between bars
                },
                y: {
                    beginAtZero: true,
                    ticks: {
                        color: '#000', // Y axis label color
                    },
                    grid: {
                        drawBorder: false,
                        color: 'rgba(0, 0, 0, 0.1)', // Light grid lines
                    }
                }
            }
        }
    };

    new Chart(ctx, config);
});
