$(document).ready(function() {

    if($('#notification-list').length) {
        // COMPLAINT DASHBOARD NOTIFICATION
        window.Echo.channel(`response-complaint-to-user-${$('meta[name="user-id"]').attr('content')}`)
            .listen('ResponseComplaintSent', (e) => {
                
                addTotalNotification()
                
                // 
                $('#notification-list').prepend(`
                    <a href="/app/response/${e.data.history_id}">
                        <div class="text-sm p-2 mb-2 text-gray-700 shadow-sm border-s-4 border-[#5aa9e6] bg-[#5aa9e61f]">
                            <div class="text-gray-700 font-medium mb-2 capitalize flex justify-between">
                                complaint
                                <div class="text-xs text-gray-500">
                                    ${e.data.response_at}
                                </div>
                            </div>
                            <div class="text-sm text-gray-600 line-clamp-2">
                                Your complaint about <span class="font-medium text-black">"${e.data.title}"</span> has been responded to by the admin. Click to see the response
                            </div>
                        </div>
                    </a>
                `)
            });

        // BOOKING CLASS DASHBOARD NOTIFICATION
        window.Echo.channel(`response-booking-class-to-user-${$('meta[name="user-id"]').attr('content')}`)
            .listen('ResponseBookingClassSent', (e) => {

                addTotalNotification()
                
                // 
                $('#notification-list').prepend(`
                    <a href="/app/response/${e.data.history_id}">
                        <div class="text-sm p-2 mb-2 text-gray-700 shadow-sm border-s-4 border-[#ff6392] bg-[#ff639214]">
                            <div class="text-gray-700 font-medium mb-2 capitalize flex justify-between">
                                Booking Class
                                <div class="text-xs text-gray-500">
                                    ${e.data.response_at}
                                </div>
                            </div>
                            <div class="text-sm text-gray-600 line-clamp-2">
                                Your booking class <span class="font-medium text-black">"${e.data.title}"</span> has been responded to by the admin. Click here to see the response
                            </div>
                        </div>
                    </a>
                `)
            });
    }
})


const addTotalNotification = () => {
    const totalNotification = parseInt($(`#total-notification-user`).html());
    $(`#total-notification-user`).html(totalNotification + 1);
}