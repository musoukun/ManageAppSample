@props([
    'form' => '',
    'id' => '',
    'name' => 'clearButton',
    'class' => '',
])
<script>
    window.onload = function() {
        document.getElementById("{{ $id }}").onclick = function() {

            formElement = document.getElementById("{{ $form }}");
            formElement.reset();

        };
    };
</script>
<x-button id="{{ $id }}" name="{{ $name }}" class="{{ $class }}">
</x-button>
