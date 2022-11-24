import '~quill/dist/quill.snow.css'
import Quill from 'quill/dist/quill';

document.addEventListener("DOMContentLoaded", function() {
    /* Quill toolbar setting */
    const quillToolbar = [
        ['bold', 'italic', 'underline', 'strike'],
        ['blockquote', 'code-block'],

        // [{ 'header': 1 }, { 'header': 2 }],
        [{ 'list': 'ordered'}, { 'list': 'bullet' }],
        [{ 'script': 'sub'}, { 'script': 'super' }],
        [{ 'indent': '-1'}, { 'indent': '+1' }],
        // [{ 'direction': 'rtl' }],

        [{ 'size': ['small', false, 'large', 'huge'] }],
        [{ 'header': [2, 3, 4, false] }],

        [{ 'color': [] }, { 'background': [] }],
        // [{ 'font': [] }],
        [{ 'align': [] }],

        ['clean'],
    ];

    /* Quill editor */
    window.quillCreateEditor = new Quill('.quill-editor', {
        debug: 'warn',
        modules: {
            syntax: false,
            toolbar: quillToolbar,
        },
        placeholder: 'Type something ...',
        readOnly: false,
        theme: 'snow',
    })

    /* Quill form */
    const form = document.querySelector('.quill-form');
    if (form) {
        form.onsubmit = function() {
            const quillInput = document.querySelector('input[name=quill]');
            // quillInput.value = JSON.stringify(quillCreateEditor.getContents());
            if (quillInput) {
                quillInput.value = quillCreateEditor.root.innerHTML;
                return true;
            }
            return false;
        };
    }
});
