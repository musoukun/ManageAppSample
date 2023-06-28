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

                <form action="{{ route('manageapp.employee.search.post') }}" method="POST" id="back"
                    name="back">
                    @csrf
                    <button class=" flex text-lg font-bold" type="submit" name='back' value="back">
                        <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" class="mr-6 dark:text-gray-200">
                            <circle cx="12" cy="12" r="10" />
                            <path d="M12 8l-4 4 4 4M16 12H9" />

                        </svg>
                        <h1 class="mt-1">{{ $title }}</h1>
                    </button>
                </form>

                @if ($errors->any())

                    <div id="accordion-color" data-accordion="collapse"
                        data-active-classes="bg-blue-100 dark:bg-gray-800 text-blue-600 dark:text-white">
                        <h2 id="accordion-color-heading-1">
                            <button type="button"
                                class="flex items-center border border-b-0 border-red-300 text-left text-gray-700 hover:bg-blue-100 focus:ring-blue-200 dark:text-gray-200"
                                data-accordion-target="#accordion-color-body-1" aria-expanded="false"
                                aria-controls="accordion-color-body-1">
                                <span>エラー表示</span>
                                <svg data-accordion-icon class="h-6 w-6 shrink-0 rotate-180" fill="currentColor"
                                    viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd"
                                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                        clip-rule="evenodd"></path>
                                </svg>
                            </button>
                        </h2>
                        <div id="accordion-color-body-1" class="hidden" aria-labelledby="accordion-color-heading-1">
                            <div class="alert alert-danger mt-2 text-sm text-red-600 dark:text-red-400">
                                <ul>
                                    @foreach ($errors->all() as $message)
                                        <li>{{ $message }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>

                    </div>

                @endif

                <x-flashMessage message="{{ session('message') }}"></x-flashMessage>

                <form class="grid grid-cols-7 gap-1" action="{{ route('manageapp.employee.insert') }}" method="POST"
                    id="EmployeeCreateform" name="EmployeeCreateform">
                    @csrf
                    {{-- <a href="{{ route('manageapp.employee.search.get') }}">
                    </a> --}}

                    <div class="col-span-4 row-start-2">
                        <x-flowbite.lrinput Leftlabel="姓" Rightlabel="名" Leftid="staffFirstName"
                            Rightid="staffLastName" :RformData="$request->staffFirstName" :LformData="$request->staffLastName">氏名
                        </x-flowbite.lrinput>

                        <x-flowbite.lrinput Leftlabel="セイ" Rightlabel="メイ" Leftid="staffFirstNameKana"
                            Rightid="staffLastNameKana" :RformData="$request->staffFirstNameKana" :LformData="$request->staffLastNameKana">フリガナ
                        </x-flowbite.lrinput>

                        <x-flowbite.code-select id="sex" name="sex" codeKey="sex" :value="$request->sex">性別
                        </x-flowbite.code-select>

                        <x-flowbite.code-select id="departmentCode" name="departmentCode" codeKey="departmentCode"
                            :value="$request->departmentCode">部署
                        </x-flowbite.code-select>

                        <x-flowbite.input id="travelCost" name="travelCost" :value="$request->travelCost">交通費_税抜
                        </x-flowbite.input>

                        <x-flowbite.datepicker id="birthdate" name="birthdate">生年月日</x-flowbite.datepicker>

                        <x-flowbite.input id="postcode" name="postcode" :value="$request->postcode">郵便番号</x-flowbite.input>

                        <x-flowbite.input id="address" name="address" :value="$request->address">住所</x-flowbite.input>

                        <x-flowbite.input id="tel" name="tel" :value="$request->tel">電話</x-flowbite.input>

                        <x-flowbite.input id="mail" name="mail" :value="$request->mail">メール</x-flowbite.input>

                        <x-flowbite.input id="remark" name="remark" :value="$request->remark">備考</x-flowbite.input>

                        <div class="mt-4 flex" role="group">
                            <button type="submit" name="insert" id="insert"
                                class="mr-6 mb-2 rounded-lg bg-gradient-to-br from-purple-600 to-blue-500 px-5 py-2.5 text-center text-sm font-medium text-white hover:bg-gradient-to-bl focus:outline-none focus:ring-4 focus:ring-blue-300 dark:focus:ring-blue-800">
                                登録
                            </button>
                        </div>
                    </div>
                </form>
            </main>
        </div>
    </div>
</body>

</html>
