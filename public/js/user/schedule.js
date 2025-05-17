let mainClassId
let timeStart
let date
let timeEnd

if($('[id^="booking-class-form-"]')) {
    $('[id^="booking-class-form-"]').on('click', function() {
        mainClassId = $(this).attr('id').split('-').pop()
        
        timeStart = $(this).data('timeStart')
        timeEnd = $(this).data('timeEnd')
        date = $(this).data('date')
        const className = $(this).data('className')

        $('#start-time-schedule').text(`${timeStart}:00`)
        $(`#input-total_hour`).attr('max', timeEnd-timeStart)
        $(`#preview-total_hour`).text(`(Max: ${timeEnd-timeStart} hours)`)
    });
}

const bookClass = (e, buttonName) => {
    e.preventDefault()
    const buttonComponent = document.getElementById(`button-${buttonName}`)
    buttonComponent.disabled = true
    buttonComponent.classList.remove('hover:bg-[#FBBC05]', 'cursor-pointer')
    buttonComponent.classList.replace('bg-[#FBBC05]', 'bg-[#fbbd059a]')
    buttonComponent.innerHTML = `Processing... <span class="mini-loader ms-2"></span>`

    const titleInput = $(`#input-title`).val()

    const selectedDate = $('input[name="list-radio"]:checked').val();
    let bookDate = getDateFromDayName(date, selectedDate)

    const endInput = parseInt($(`#input-total_hour`).val()) + timeStart
    const descInput = $('#description').val()
    
    const getData = {
        'class_id': mainClassId,
        'title': titleInput,
        'date': bookDate,
        'start': formatHourToTime(timeStart),
        'end': formatHourToTime(endInput),
        'description': descInput
    }

    console.log(getData);
}

const submitForm = () => {
    $.ajax({
        url: "/app/change-email-notification-permission",
        type: "POST",
        headers: {
            "X-CSRF-Token": $('meta[name="csrf-token"]').attr("content")
        },
        data: {
            'class_id': 8
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

function getDateFromDayName(dayName, selectedWeek = "1") {
    const dayIndexMap = {
        'Sunday': 0,
        'Monday': 1,
        'Tuesday': 2,
        'Wednesday': 3,
        'Thursday': 4,
        'Friday': 5,
        'Saturday': 6
    };

    const today = new Date();
    const currentDayIndex = today.getDay();

    const targetDayIndex = dayIndexMap[dayName];

    const baseOffset = (7 * (parseInt(selectedWeek) - 1)); 
    const dayOffset = (targetDayIndex - currentDayIndex + 7) % 7;

    const totalOffset = baseOffset + dayOffset;

    const resultDate = new Date();
    resultDate.setDate(today.getDate() + totalOffset);

    return resultDate.toISOString().split('T')[0];
}

function formatHourToTime(hour) {
    const formattedHour = hour.toString().padStart(2, '0');
    return `${formattedHour}:00`;
}