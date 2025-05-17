const classPageMenu = ['class-list', 'schedule-list', 'booking-class'];

$(document).ready(function() {
    const savedPage = localStorage.getItem('activeClassPage') || 'class-list';
    changeClassPage(savedPage);
});

const changeClassPage = (page) => {
    localStorage.setItem('activeClassPage', page);

    classPageMenu.forEach((item) => {
        if (item === page) {
            $(`#${item}`).removeClass('hidden');
            $(`#btn-${item}`)
                .removeClass('bg-gray-200 text-gray-700')
                .addClass('bg-[#FBBC05] text-white');
        } else {
            $(`#${item}`).addClass('hidden');
            $(`#btn-${item}`)
                .removeClass('bg-[#FBBC05] text-white')
                .addClass('bg-gray-200 text-gray-700');
        }
    });
};
