$(document).ready(function () {
    const $inputImage = $('.filepond');

    if ($inputImage.length) {
        // Register plugin tambahan
        FilePond.registerPlugin(
            FilePondPluginImagePreview,
            FilePondPluginImageResize,
            FilePondPluginFileValidateSize,
            FilePondPluginImageExifOrientation
        );

        // Buat instance FilePond (jika lebih dari satu, bisa pakai each)
        $inputImage.each(function () {
            FilePond.create(this, {
                allowMultiple: true,
                maxFiles: 5,
                acceptedFileTypes: ['image/*'],
                maxFileSize: '2MB',
                server: {
                    process: '/upload',
                    revert: '/revert',
                }
            });
        });
    }
});
