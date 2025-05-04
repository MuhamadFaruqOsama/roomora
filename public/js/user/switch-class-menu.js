const classPageMenu = ['class-list', 'schedule-list', 'booking-class']

const changeClassPage = (page) => {
    classPageMenu.forEach((item) => {
        if(item !== page) {
            document.getElementById(item).classList.add('hidden')
            document.getElementById(`btn-${item}`).classList.replace('bg-[#FBBC05]', 'bg-gray-200')
        } else {
            document.getElementById(item).classList.remove('hidden')
            document.getElementById(`btn-${item}`).classList.replace('bg-gray-200', 'bg-[#FBBC05]')
        }
    })
}