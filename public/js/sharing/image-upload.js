$(document).ready(function () {
    const $inputImage = $('.filepond');

    if ($inputImage.length) {
        // Register plugins
        FilePond.registerPlugin(
            FilePondPluginImagePreview,
            FilePondPluginImageResize,
            FilePondPluginFileValidateSize,
            FilePondPluginImageExifOrientation
        );

        // Setup each FilePond input
        $inputImage.each(function () {
            FilePond.create(this, {
                labelIdle: '<span class="filepond--label-action">Click here to upload photo evidence</span>',
                name: 'photo_evidence',
                allowMultiple: true,
                maxFiles: 5,
                acceptedFileTypes: ['image/*', 'application/pdf'],
                maxFileSize: '5MB',
                server: {
                    process: {
                        url: '/upload',
                        method: 'POST',
                        headers: {
                            "X-CSRF-Token": $('meta[name="csrf-token"]').attr("content")
                        },
                        onload: (response) => {
                            console.log(response);
                            
                            return response;
                        }
                    },
                    revert: {
                        url: '/revert',
                        method: 'POST',
                        headers: {
                            "X-CSRF-Token": $('meta[name="csrf-token"]').attr("content")
                        }
                    }
                },
            });
        });
    }
});
