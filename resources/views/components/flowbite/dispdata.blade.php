@props([
    'divclass' => 'text-sm font-medium',
    'labelclass' => 'text-sm font-medium',
    'label' => '',
])


<div class="{{ $divclass }}">

    <div <x-flowbite.label class="{{ $labelclass }}">{{ $label }}</x-flowbite.label>
        {{ $attributes->merge(['class' => 'apearance-none py-2 px-4 leading-tight focus:border-purple-500 focus:bg-white focus:outline-none']) }}>
        @isset($slot)
            {{ $slot }}
        @endisset
    </div>

</div>
