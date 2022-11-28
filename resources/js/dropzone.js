/* Dropzone CSS */
import '~dropzone/src/dropzone.scss'

/* Dropzone JS */
import Dropzone from "dropzone";

document.addEventListener("DOMContentLoaded", function() {
    /* Dropzone container */
    // let cmsDropzone = new Dropzone('.dropzone-container');
    window.dropzone = new Dropzone('.dropzone-container');

    dropzone.on("addedfile", file => {
        console.log(`File added: ${file.name}`);
    });
});
