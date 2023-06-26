@props([
    'Leftid' => '',
    'Rightid' => '',

    'Lplaceholder' => '',
    'Rplaceholder' => '',

    'labelclass' => '',
    'Llabelclass' => '',
    'Rlabelclass' => '',

    'Lvalue' => '',
    'Rvalue' => '',

    'label' => '',
    'Llabel' => '',
    'Rlabel' => ' ',
    'css' => 'bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500',
])

<div class="mb-6 grid gap-6 md:grid-cols-2">
    <div>
        <x-flowbite.label class="{{ $labelclass }}">{{ $slot }}</x-flowbite.label>
        @isset($Leftlabel)
            <x-flowbite.label class="{{ $Llabelclass }}">{{ $Llabel }}</x-flowbite.label>
        @endisset
        <input type="text" value="{{ old($Leftid, $Lvalue ?? '') }}" name="{{ $Leftid }}" id="{{ $Leftid }}"
            {{ $attributes->merge(['class' => $css])->class(['bg-gray-50', 'bg-red-300' => $errors->has($Leftid)]) }}
            placeholder="{{ $Lplaceholder }} ">
        @error($Leftid)
            <div class="relative px-1 py-1 text-red-700">{{ $message }}
            </div>
        @enderror
    </div>
    <div>
        <x-flowbite.label class="{{ $labelclass }}">　</x-flowbite.label>
        @isset($Rightlabel)
            <x-flowbite.label class="{{ $Rlabelclass }}">{{ $Rlabel }}</x-flowbite.label>
        @endisset
        <input type="text" value="{{ old($Rightid, $Rvalue ?? '') }}" name="{{ $Rightid }}"
            id="{{ $Rightid }}"
            {{ empty($Rightid) ? null : $attributes->merge(['name' => $Rightid, 'id' => $Rightid]) }}
            {{ $attributes->merge(['class' => $css])->class(['bg-gray-50', 'bg-red-300' => $errors->has($Rightid)]) }}
            placeholder="{{ $Rplaceholder }}">
        @error($rightid)
            <div class="relative px-1 py-1 text-red-700">{{ $message }}
            </div>
        @enderror

    </div>

</div>
