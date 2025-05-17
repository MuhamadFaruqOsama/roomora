const getNotification = (msg, isSuccess = true) => {
    const notyf = new Notyf({
        duration: 5000,
        dismissible: true,
        position: {
            x: 'center',
            y: 'bottom'
        }
    });

    isSuccess ? 
    notyf.success(msg) :
    notyf.error(msg);
}