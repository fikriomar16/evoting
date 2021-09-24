function miniNotif(status, msg) {
    const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 6000,
        timerProgressBar: true,
        didOpen: (toast) => {
            toast.addEventListener('mouseenter', Swal.stopTimer)
            toast.addEventListener('mouseleave', Swal.resumeTimer)
        }
    })
    Toast.fire({
        icon: status,
        title: msg
    })
}
function regNotif(title,text,status) {
    Swal.fire({
        title: title,
        text: text,
        icon: status
    });
}