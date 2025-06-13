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
        handleDayClick(date)

        $(`#start-time-schedule-${mainClassId}`).text(`${timeStart}:00`)
        $(`#input-total_hour-${mainClassId}`).attr('max', timeEnd-timeStart)
        $(`#preview-total_hour-${mainClassId}`).text(`(Max: ${timeEnd-timeStart} hours)`)
        $(`#day-schedule-${mainClassId}`).text(date)
        $(`#class-name-${mainClassId}`).text(mainClassId)
    });
}

const bookClass = (e, buttonName, id) => {
    e.preventDefault()
    const buttonComponent = document.getElementById(`button-${buttonName}`)
    buttonComponent.disabled = true
    buttonComponent.classList.remove('hover:bg-[#FBBC05]', 'cursor-pointer')
    buttonComponent.classList.replace('bg-[#FBBC05]', 'bg-[#fbbd059a]')
    buttonComponent.innerHTML = `Processing... <span class="mini-loader ms-2"></span>`

    const titleInput = $(`#input-title_${id}`).val()

    const selectedDate = $(`input[name="list-radio-${id}"]:checked`).val();
    let bookDate = getDateFromDayName(date, selectedDate)

    

    const endInput = parseInt($(`#input-total_hour-${id}`).val()) + timeStart
    const descInput = $(`#description-${id}`).val()
    
    const getData = {
        'class_id': mainClassId,
        'title': titleInput,
        'date': bookDate,
        'start': formatHourToTime(timeStart),
        'end': formatHourToTime(endInput),
        'description': descInput
    }

    submitForm(getData, id)
}

const submitForm = (formData, id) => {
    $.ajax({
        url: "/app/class-json",
        type: "POST",
        headers: {
            "X-CSRF-Token": $('meta[name="csrf-token"]').attr("content")
        },
        data: formData,
        success: function(response) {
            getNotification(response.message, response.status);
            // kosongkan value
            $(`#input-title_${id}`).val('')
            $(`#input-total_hour-${id}`).val('')
            $(`#description-${id}`).val('')

            // kembalikan button
            const buttonComponent = document.getElementById(`button-booking-class`)
            buttonComponent.disabled = false
            buttonComponent.classList.add('hover:bg-[#FBBC05]', 'cursor-pointer')
            buttonComponent.classList.replace('bg-[#fbbd059a]', 'bg-[#FBBC05]')
            buttonComponent.innerHTML = `Submit`
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

function handleDayClick(clickedDayName) {
    const daysOfWeek = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];
    const today = new Date();
    const todayIndex = today.getDay(); 
    const clickedIndex = daysOfWeek.indexOf(clickedDayName);

    if (clickedIndex === -1) return;

    if (clickedIndex <= todayIndex) {
        $('#radio-input-this-week').hide();

        $('#next-week').prop('checked', true);
    } else {
        $('#radio-input-this-week').show();
    }
}