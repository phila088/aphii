import '../assets/js/custom';
import './bootstrap'
import { Livewire, Alpine} from '../../vendor/livewire/livewire/dist/livewire.esm'
// import '../../public/js/preline/dist/preline';
// import Alpine from 'alpinejs'
import mask from '@alpinejs/mask';
import jQuery from 'jquery'

window.$ = jQuery;
window.Alpine = Alpine
Alpine.plugin(mask);
Livewire.start();
