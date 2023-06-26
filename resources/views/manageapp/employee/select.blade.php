<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<link rel="shortcut icon" type="image/x-icon" href="{{ asset('images/manageapp-favicon.ico') }}">

<body class="dark:bg-gray-700">
    @vite('resources/css/app.css')
    @vite('resources/js/app.js', 'build', 'resources/sass/app.scss'){{-- npm run build対応済 --}}
    <div class="bg-gray-50 antialiased dark:bg-gray-700">
        <x-flowbite.navbar></x-flowbite.navbar>
        <x-flowbite.sidebar></x-flowbite.sidebar>

        <div class="rounded-lg border-2 border-dashed border-gray-200 dark:border-gray-700">
            <main class="mt-24 p-4 md:ml-64">
                <div class="flex">
                    <a href="{{ route('manageapp') }}">
                        <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" class="mr-6 dark:text-gray-200">
                            <circle cx="12" cy="12" r="10" />
                            <path d="M12 8l-4 4 4 4M16 12H9" />

                        </svg>
                    </a>
                    <div class="my-2 ml-2 items-center text-lg font-bold">
                        <h1>{{ $title }}</h1>
                    </div>
                </div>


                <div class="grid grid-cols-7 gap-1">
                    <div class="col-span-4">

                        <x-flowbite.lrinput Leftlabel="姓" Rightlabel="名" Leftid="staffFirstName"
                            Rightid="staffLastName" :Rvalue="$selectData->staffFirstName" :Lvalue="$selectData->staffLastName">氏名
                        </x-flowbite.lrinput>

                        <x-flowbite.lrinput Leftlabel="セイ" Rightlabel="メイ" Leftid="staffFirstNameKana"
                            Rightid="staffLastNameKana" :Rvalue="$selectData->staffFirstNameKana" :Lvalue="$selectData->staffLastNameKana">フリガナ
                        </x-flowbite.lrinput>

                        <x-flowbite.code-select id="sex" name="sex" codeKey="sex" :fromData="$selectData->sex">性別
                        </x-flowbite.code-select>

                        <x-flowbite.code-select id="departmentCode" name="departmentCode" codeKey="departmentCode"
                            :value="$selectData->departmentCode">部署
                        </x-flowbite.code-select>

                        <x-flowbite.input id="travelCost" name="travelCost" :value="$selectData->travelCost">交通費_税抜
                        </x-flowbite.input>

                        <x-flowbite.datepicker id="birthdate" name="birthdate" value="$selectData->birthdate">生年月日</x-flowbite.datepicker>

                        <x-flowbite.input id="postcode" name="postcode" :value="$selectData->postcode">郵便番号</x-flowbite.input>

                        <x-flowbite.input id="address" name="address" :value="$selectData->address">住所</x-flowbite.input>

                        <x-flowbite.input id="tel" name="tel" :value="$selectData->tel">電話</x-flowbite.input>

                        <x-flowbite.input id="mail" name="mail" :value="$selectData->mail">メール</x-flowbite.input>

                        <x-flowbite.input id="remark" name="remark" :value="$selectData->remark">備考</x-flowbite.input>

                    </div>
                </div>

            </main>
        </div>
    </div>

</body>

</html>
