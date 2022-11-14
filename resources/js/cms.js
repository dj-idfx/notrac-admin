// Import laravel bootstrap JS
import './bootstrap';

// Import Bootstrap Icons CSS
import '~bootstrap-icons/font/bootstrap-icons.scss'

// Import CMS CSS
import '../scss/cms.scss'

// Import Popper JS
import * as Popper from '@popperjs/core';
window.Popper = Popper;

// Bootstrap JS Option 2: Import full Bootstrap 5
import * as Bootstrap from '~bootstrap';
window.Bootstrap = Bootstrap;

/*
 * Extra admin scripts
 */
window.onload = function() {
    showSidebar(); // todo: refactor function to event listener on querySelectorAll
}

/* Show Sidebar Toggler */
function showSidebar() {
    const toggle = document.querySelector('[data-js-class="js-show-sidebar"]');

    if (toggle) {
        toggle.onclick = function() {
            document.body.classList.toggle('js-show-sidebar');
        };
    }
}
