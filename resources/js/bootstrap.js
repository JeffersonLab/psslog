import axios from 'axios';
window.axios = axios;
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

import flatpickr from "flatpickr";

import Alpine from 'alpinejs';
window.Alpine = Alpine;
Alpine.start();

import 'htmx.org';
import 'flowbite';





