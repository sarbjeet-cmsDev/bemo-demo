import Swal from 'sweetalert2';

const alertService = {
  confirm(message, title = 'Confirm') {
    return Swal.fire({
      title: title,
      text: message,
      icon: 'question',
      showCancelButton: true,
    });
  },
  success(message, title = 'Success') {
    this.showAlert(message, title, 'success');
  },
  error(message, title = 'Error') {
    this.showAlert(message, title, 'error');
  },
  warning(message, title = 'Warning') {
    this.showAlert(message, title, 'warning');
  },
  info(message, title = 'Info') {
    this.showAlert(message, title, 'info');
  },
  showAlert(message, title, type) {
    // Assuming SweetAlert2 is available globally as Swal
    Swal.fire({
      title: title,
      text: message,
      icon: type,
      toast: true,
      position: 'top-end',
      showConfirmButton: false,
      timer: 3000,
      timerProgressBar: true,
      didOpen: (toast) => {
        toast.addEventListener('mouseenter', Swal.stopTimer);
        toast.addEventListener('mouseleave', Swal.resumeTimer);
      }
    });
  }
};

export default alertService;
