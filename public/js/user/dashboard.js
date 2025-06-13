$(document).ready(function() {
    const $chartElement = $('#activity-chart');
    
    if ($chartElement.length) {
        const bookingClass = parseInt($('#activity-data').data('bookingClass'))
        const complaint = parseInt($('#activity-data').data('complaint'))

        const myDoughnutChart = new Chart($chartElement[0], {
            type: 'doughnut',
            data: {
                labels: ['Booking Class', 'Complaint'],
                datasets: [{
                    label: 'Jumlah',
                    data: [bookingClass, complaint],
                    backgroundColor: ['#5aa9e6', '#ff6392'],
                    hoverOffset: 10
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
    }
});
