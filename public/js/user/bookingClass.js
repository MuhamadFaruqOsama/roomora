const cancelBookingClass = (id) => {
    $.ajax({
        url: "/app/cancel-booking-class",
        type: "DELETE",
        headers: {
            "X-CSRF-Token": $('meta[name="csrf-token"]').attr("content")
        },
        data: { id },
        success: function(response) {
            getNotification(response.message, response.status);

            if(response.status) {
                window.location = "/app/history"
            }
        },
        error: function(xhr, status, error) {
            console.error("Error:", error);
            notyf.error("An error occurred. Please try again.");
            $btn.prop("disabled", false);
            $btn.html(`<div class="mt-5 cursor-pointer text-blue-500 transition-all hover:text-blue-600 text-sm">Resend OTP</div>`);
        }
    });
}

$(document).ready(function() {
    // BOOKING CLASS NOTIFICATION
    window.Echo.channel('booking-class-to-admin')
        .listen('BookingClassSent', (e) => {
            getNotification('New booking class received', true)
            const newRow = classBookingTable(e.message)
            dataGeneralTable.unshift(newRow)
            
            // add to table
            gridTable.updateConfig({
                data: dataGeneralTable
            }).forceRender();
        });
})