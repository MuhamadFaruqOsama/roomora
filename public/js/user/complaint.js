const confirmComplaint = (id) => {
    $.ajax({
        url: "/app/confirm-complaint",
        type: "POST",
        headers: {
            "X-CSRF-Token": $('meta[name="csrf-token"]').attr("content")
        },
        data: {'complaint_id': id},
        success: function(response) {
            getNotification(response.message, response.status);

            if(response.status) {
                window.location.reload();
            }
        },
        error: function(xhr, status, error) {
            console.error("Error:", error);
            notyf.error("An error occurred. Please try again.");
            $btn.prop("disabled", false);
            $btn.html(`<div class="mt-5 cursor-pointer text-blue-500 transition-all hover:text-blue-600 text-sm">Resend OTP</div>`);
        }
    })
}