// const classPageMenu = ['class-list', 'schedule-list', 'booking-class'];
const classPageMenu = ['class-list', 'schedule-list'];

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
                .removeClass('bg-gray-200')
                .addClass('bg-[#ffe45e]');
        } else {
            $(`#${item}`).addClass('hidden');
            $(`#btn-${item}`)
                .removeClass('bg-[#ffe45e]')
                .addClass('bg-gray-200');
        }
    });
};
