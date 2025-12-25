<div
    x-data="{}"
    x-init="
        window.addEventListener('swal', event => {
            Swal.fire({
                icon: event.detail.icon,
                title: event.detail.message,
                showConfirmButton: false,
                timer: 3000,
                toast: true,
                position: 'top-end',
                timerProgressBar: true
            });
        });
    "
></div>
