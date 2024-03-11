import '../assets/js/custom';
import './bootstrap'
import '../../public/js/preline';
import Alpine from 'alpinejs'
import mask from '@alpinejs/mask';
import jQuery from 'jquery';

window.Alpine = Alpine
Alpine.plugin(mask);
Alpine.start()
window.$ = jQuery;
