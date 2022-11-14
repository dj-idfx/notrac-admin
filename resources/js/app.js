// Import laravel bootstrap JS
import './bootstrap';

// Import Bootstrap Icons CSS
import '~bootstrap-icons/font/bootstrap-icons.scss'

// Import APP CSS
import '../scss/app.scss'

// Import Popper JS
import * as Popper from '@popperjs/core';
window.Popper = Popper;

// Bootstrap JS Option 1: Import separate Bootstrap 5 plugins
// import { Alert, Button, Carousel, Collapse, Dropdown, Modal, Offcanvas, Popover, ScrollSpy, Tab, Toast, Tooltip } from 'bootstrap';
import 'bootstrap/js/dist/collapse'
import 'bootstrap/js/dist/dropdown';

// Proces static assets
import.meta.glob([
    '../favicon/**', '!../favicon/info.txt',
]);
