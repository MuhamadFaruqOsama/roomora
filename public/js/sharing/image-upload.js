$(document).ready(function () {
    const $inputImage = $('.filepond');
    if($inputImage.length) {
        $inputImage.dropify({
            messages: {
                'default': 'drag or drop photo evidance here',
                'replace': 'Drag and drop or click to replace',
                'remove':  'Remove',
                'error':   'Ooops, something wrong happended.'
            }
        });
    }

    const $roomImage = $('#room-picture-input');
    if($roomImage.length) {
        $roomImage.dropify({
            messages: {
                'default': 'drag or drop room picture here',
                'replace': 'Drag and drop or click to replace',
                'remove':  'Remove',
                'error':   'Ooops, something wrong happended.'
            }
        });
    }

    const $360Picture = $('#360-picture-input');
    if($360Picture.length) {
        $360Picture.dropify({
            messages: {
                'default': 'drag or drop 360 picture here',
                'replace': 'Drag and drop or click to replace',
                'remove':  'Remove',
                'error':   'Ooops, something wrong happended.'
            }
        });
    }
});
