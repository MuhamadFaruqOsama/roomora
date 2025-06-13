$(document).ready(function() {
    // COMPLAINT NOTIFICATION
    window.Echo.channel('complaint-to-admin')
        .listen('ComplaintSent', (e) => {
            getNotification('New complaint received', true)
        });

    // CONFIRM COMPLAINT NOTIFICATION 
    window.Echo.channel('confirm-complaint-to-admin')
        .listen('ConfirmComplaintSent', (e) => {
            getNotification(`user with ID: ${e.data.user_id} have confirmed your complaint response`, true)
        });

    // BOOKING CLASS NOTIFICATION 
    window.Echo.channel('booking-class-to-admin')
        .listen('BookingClassSent', (e) => {
            getNotification('New booking class received', true)
        });

})