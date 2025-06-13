const confirmModal = (message, id = null) => {
    Swal.fire({
        title: 'Confirm',
        text: message,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Yes',
        cancelButtonText: 'No'
    }).then((result) => {
        if (result.isConfirmed) {
            deleteClass(id)
        }
    });
}