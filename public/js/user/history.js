$(document).ready(function() {

    if($(`#history-list`).length) {
        // COMPLAINT NOTIFICATION BADGE
        window.Echo.channel(`response-complaint-to-user-${$('meta[name="user-id"]').attr('content')}`)
            .listen('ResponseComplaintSent', (e) => {
                $(`#complaint-badge-${e.data.id}`).html('<span class="text-green-500 px-2 py-1 rounded-full ms-2 h-fit text-xs bg-green-100">finished</span>')
            });

        // BOOKING CLASS NOTIFICATION BADGE
        window.Echo.channel(`response-booking-class-to-user-${$('meta[name="user-id"]').attr('content')}`)
            .listen('ResponseBookingClassSent', (e) => {
                $(`#booking-class-badge-${e.data.id}`).html('<span class="text-blue-500 px-2 py-1 rounded-full ms-2 h-fit text-xs bg-blue-100">accepted</span>')
            });
    }
})