const editEmailNotificationPermission = () => {
    $.ajax({
        url: "/app/change-email-notification-permission",
        type: "POST",
        headers: {
            "X-CSRF-Token": $('meta[name="csrf-token"]').attr("content")
        },
        success: function(response) {
            getNotification(response.message, response.status);
        },
        error: function(xhr, status, error) {
            console.error("Error:", error);
            notyf.error("An error occurred. Please try again.");
            $btn.prop("disabled", false);
            $btn.html(`<div class="mt-5 cursor-pointer text-blue-500 transition-all hover:text-blue-600 text-sm">Resend OTP</div>`);
        }
    })
}