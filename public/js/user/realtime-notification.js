$(document).ready(function() {
    // COMPLAINT NOTIFICATION
    window.Echo.channel(`response-complaint-to-user-${$('meta[name="user-id"]').attr('content')}`)
        .listen('ResponseComplaintSent', (e) => {
            getNotification('Admin has responded to the complaint you submitted.', true)
        });

    // BOOKING CLASS NOTIFICATION
    window.Echo.channel(`response-booking-class-to-user-${$('meta[name="user-id"]').attr('content')}`)
        .listen('ResponseBookingClassSent', (e) => {
            getNotification('Admin has responded to the class you want to book.', true)
        });
})