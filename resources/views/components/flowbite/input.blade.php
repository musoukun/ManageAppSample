@props([
    'labelclass' => '',
    'label' => '',
    'name' => '',
    'id' => '',
    'value' => '',
    'css' => 'bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500',
])
<x-flowbite.label class="{{ $labelclass }}">{{ $slot }}</x-flowbite.label>
<input value="{{ old($name, $value) }}" name="{{ $name }}" id="{{ $id }}"
    {{ $attributes->merge(['class' => $css])->class(['bg-gray-50', 'bg-red-300' => $errors->has($name)]) }}>
@error($name)
    <div class="relative px-1 py-1 text-red-700">
        {{ $message }}
    </div>
@enderror
</input>
{{-- 
@isset($slot)
    <div class="ml-4 text-red-500">{{ $slot }}</div>
@endisset --}}
