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

// Bootstrap JS Option 2: Import full Bootstrap 5 JS
// import * as Bootstrap from '~bootstrap';
// window.Bootstrap = Bootstrap;
