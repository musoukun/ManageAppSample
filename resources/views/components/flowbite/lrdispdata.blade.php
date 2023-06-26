@props([
    'labelclass' => 'text-sm font-medium',
    'label' => '',
    'leftdata' => '',
    'rightdata' => '',
])


<div class="mb-1 flex items-center">

    <x-label class="{{ $labelclass }}">{{ $label }}</x-label>
    <div>
        {{ $attributes->merge(['class' => 'apearance-none py-2 px-4 leading-tight focus:border-purple-500 focus:bg-white focus:outline-none']) }}
        {{ $leftdata }}
    </div>
    {{ $slot }}
    <div>
        {{ $attributes->merge(['class' => 'apearance-none py-2 px-4 leading-tight focus:border-purple-500 focus:bg-white focus:outline-none']) }}>
        {{ $rightdata }}
    </div>


</div>
