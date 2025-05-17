function resendOTP() {
    const $btn = $("#resend-btn");
    $btn.prop("disabled", true);
    $btn.html(`<div class="mt-5 cursor-pointer text-gray-500 text-sm">Resending...</div>`);

    $.ajax({
        url: "/resend-OTP",
        type: "GET",
        headers: {
            "X-CSRF-Token": $('meta[name="csrf-token"]').attr("content")
        },
        success: function(response) {
            getNotification(response.message, response.status);
            btnCooldown();
        },
        error: function(xhr, status, error) {
            console.error("Error:", error);
            notyf.error("An error occurred. Please try again.");
            $btn.prop("disabled", false);
            $btn.html(`<div class="mt-5 cursor-pointer text-blue-500 transition-all hover:text-blue-600 text-sm">Resend OTP</div>`);
        }
    });
}

function btnCooldown() {
    const $btn = $("#resend-btn");
    let timeLeft = 60;

    const interval = setInterval(function () {
        let minutes = Math.floor(timeLeft / 60);
        let seconds = timeLeft % 60;
        let display = `${minutes}:${seconds < 10 ? '0' : ''}${seconds}`;
        $btn.html(`<div class="mt-5 cursor-pointer text-gray-500 text-sm">Resend OTP in ${display}</div>`);
        timeLeft--;

        if (timeLeft < 0) {
            clearInterval(interval);
            $btn.prop("disabled", false);
            $btn.html(`<div class="mt-5 cursor-pointer text-blue-500 transition-all hover:text-blue-600 text-sm">Resend OTP</div>`);
        }
    }, 1000);
}
