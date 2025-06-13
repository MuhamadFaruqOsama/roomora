$(document).ready(function() {
    // booking class chart
    const bookingClassChart = $('#bookingClassChart');
    if (bookingClassChart.length > 0) {
        new Chart(bookingClassChart[0].getContext('2d'), {
            type: 'doughnut',
            data: {
                labels: ['Pending', 'Accepted', 'Rejected'],
                datasets: [{
                    data: [
                        bookingClassChart.data('pending'),   // Pending
                        bookingClassChart.data('accepted'),  // Accepted
                        bookingClassChart.data('rejected')   // Rejected
                    ],
                    backgroundColor: [
                        'rgba(255, 206, 86, 0.8)',   // warna Pending (kuning)
                        'rgba(54, 162, 235, 0.8)',   // warna Accepted (biru)
                        'rgba(255, 99, 132, 0.8)'    // warna Rejected (merah)
                    ]
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'bottom'
                    }
                }
            }
        });
    }
    
    // booking class chart
    const complaintsChart = $('#complaintsChart');
    if (complaintsChart.length > 0) {
        new Chart(complaintsChart[0].getContext('2d'), {
            type: 'doughnut',
            data: {
                labels: ['Pending', 'Finished', 'Rejected', 'Confirmed'],
                datasets: [{
                    data: [
                        complaintsChart.data('pending'), 
                        complaintsChart.data('finished'),  
                        complaintsChart.data('rejected'),   // Rejected
                        complaintsChart.data('confirmed'),   // Rejected
                    ],
                    backgroundColor: [
                        'rgba(255, 206, 86, 0.8)',   // warna Pending (kuning)
                        'rgba(75, 192, 192, 0.8)',   // warna Accepted (biru)
                        'rgba(255, 99, 132, 0.8)',
                        'rgba(54, 162, 235, 0.8)'
                    ]
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'bottom'
                    }
                }
            }
        });
    }
    
    const bookingsCtx = document.getElementById('bookingsChart');
    if(bookingsCtx) {
        new Chart(bookingsCtx.getContext('2d'), {
            type: 'bar',
            data: {
                labels: ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday'],
                datasets: [{
                    label: 'Room Bookings',
                    data: [12, 19, 15, 17, 14],
                    backgroundColor: 'rgba(13, 110, 253, 0.5)',
                    borderColor: 'rgba(13, 110, 253, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    }
})