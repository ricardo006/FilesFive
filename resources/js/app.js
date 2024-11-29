import './bootstrap';
import Alpine from 'alpinejs';
import toastr from 'toastr';
import 'toastr/build/toastr.min.css';

toastr.options = {
    "closeButton": true,
    "progressBar": true,
    "positionClass": "toast-top-right",
    "timeOut": "5000"
};

window.Alpine = Alpine;

Alpine.start();
