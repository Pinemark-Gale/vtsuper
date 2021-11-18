@props(['name', 'value' => '', 'formClass' => 'admin-form'])

<input name="{{ $name }}" type="hidden">

<!-- Include stylesheet -->
<link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">

<!-- Create the editor container -->
<div id="{{ $name }}">{!! $value !!}</div>

<!-- Include the Quill library -->
<script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>

<!-- Initialize Quill editor -->
<script>
    var quill = new Quill('#{{ $name }}', {
        placeholder: 'Make your webpage here!',
        theme: 'snow'
    });

    var form = document.querySelector('form[class={{ $formClass }}]');
    form.onsubmit = function() {
        // Populate hidden form on submit
        var editor = document.querySelector('input[name={{ $name }}]');
        editor.value = quill.root.innerHTML;
    }

</script>

<x-form.error name="{{ $name }}" />
