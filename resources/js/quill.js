import '~quill/dist/quill.snow.css'
import Quill from 'quill/dist/quill';

document.addEventListener("DOMContentLoaded", function() {
    /* Quill toolbar setting */
    const quillCreateToolbar = [
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

    /* Quill create editor */
    window.quillCreateEditor = new Quill('.quill-create-editor', {
        debug: 'warn',
        modules: {
            syntax: false,
            toolbar: quillCreateToolbar,
        },
        placeholder: 'Type something ...',
        readOnly: false,
        theme: 'snow',
    })

    /* Quill create Post form */
    const form = document.querySelector('#cmsCreatePostForm');
    if (form) {
        form.onsubmit = function() {
            const quillInput = document.querySelector('input[name=quill]');
            // quillInput.value = JSON.stringify(quillCreateEditor.getContents());
            quillInput.value = quillCreateEditor.root.innerHTML;
            return true;
        };
    }

});
