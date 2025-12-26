<div
    x-data
    @swal.window="Swal.fire({
        icon: $event.detail.icon || 'success',
        title: $event.detail.title || '',
        text: $event.detail.message || '',
        showConfirmButton: false,
        timer: $event.detail.timer || 2500,
        toast: true,
        position: $event.detail.position || 'top-end',
        timerProgressBar: true,
        background: '#fff',
        color: '#000'
    })"
    @toast.window="Swal.fire({
        icon: $event.detail.type || 'success',
        title: '',
        text: $event.detail.message || '',
        showConfirmButton: false,
        timer: 2500,
        toast: true,
        position: 'top-end',
        timerProgressBar: true,
        background: '#fff',
        color: '#000'
    })"
></div>
