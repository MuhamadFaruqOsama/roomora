document.addEventListener('DOMContentLoaded', function () {
    const inputImage = document.querySelector('.filepond');
    
    if(inputImage) {
        console.log('cek');
        
        // Register plugin tambahan
        FilePond.registerPlugin(
            FilePondPluginImagePreview,  // Preview Gambar
            FilePondPluginImageResize,   // Resize otomatis
            FilePondPluginFileValidateSize, // Validasi ukuran
            FilePondPluginImageExifOrientation // Orientasi gambar
        );
    
        // Buat instance FilePond
        FilePond.create($(inputImage)[0], {
            allowMultiple: true,         // Bisa upload banyak gambar
            maxFiles: 5,                 // Maksimal 5 gambar
            acceptedFileTypes: ['image/*'], // Hanya menerima gambar
            maxFileSize: '2MB',           // Maksimal ukuran file 2MB
            server: {
                process: '/upload',  // Endpoint untuk upload file
                revert: '/revert',   // Untuk undo upload file
            }
        });
    }
})