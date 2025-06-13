const deleteClass = (id) => {
    $.ajax({
        url: "/admin/delete-class",
        type: "DELETE",
        headers: {
            "X-CSRF-Token": $('meta[name="csrf-token"]').attr("content")
        },
        data: {id},
        success: function(response) {
            if(response.status) {
                window.location = "/admin/class-management"
            }
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