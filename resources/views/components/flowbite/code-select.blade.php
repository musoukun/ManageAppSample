@props([
    'labelclass' => '',
    'label' => '',
    'value' => '',
    'id' => '',
    'name' => '',
])
{{-- <div class="w-1/6"> --}}
<x-flowbite.label class="{{ $labelclass }}">{{ $slot }}</x-flowbite.label>
<select name="{{ $name }}" id="{{ $id }}"
    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
    <option value="">選択してください</option>
    @if ($codeKey == 'departmentCode')
        @foreach ($datas as $data)
            <option value="{{ $data->departmentCode }}" @if (old($name, $value ?? '') == $data->departmentCode) selected @endif>
                {{ $data->codeAndName }}</option>
        @endforeach
    @else
        @foreach ($datas as $data)
            <option value="{{ $data->code }}" @if ($data->code == old($name, $value ?? '')) selected @endif>
                {{ $data->codeValue }}</option>
        @endforeach
    @endif
</select>
@error($name)
    <div class="relative px-1 py-1 text-red-700">{{ $message }}
    </div>
@enderror
