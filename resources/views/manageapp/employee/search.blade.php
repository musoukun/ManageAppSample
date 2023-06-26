<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
</head>

<body class="bg-gray-50 dark:bg-gray-700">
    @vite('resources/css/app.css')
    @vite('resources/js/app.js', 'build', 'resources/sass/app.scss'){{-- npm run build対応済 --}}
    <div class="bg-gray-50 antialiased dark:bg-gray-700">
        <x-flowbite.navbar></x-flowbite.navbar>
        <x-flowbite.sidebar></x-flowbite.sidebar>

        
        <div class="rounded-lg border-2 border-dashed border-gray-200 dark:border-gray-700">
            <main class="mt-24 p-4 md:ml-64">
                
                <div class="my-2 ml-2 items-center text-lg font-bold">  
                    <h1>{{ $title }}</h1>
                </div>
                <a href="/manageapp/employee/create"
                    class="text-white bg-gradient-to-br from-pink-500 to-orange-400 hover:bg-gradient-to-bl focus:ring-4 focus:outline-none focus:ring-pink-200 dark:focus:ring-pink-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2">
                    新規登録</a>
                {{-- 検索フォーム --}}
                <form class="my-3 grid gap-6 grid-cols-7" action="{{ route('manageapp.employee.search') }}" method="POST"
                    name="Employeeform">
                    @csrf
                    <div class="col-span-3">
                        <x-flowbite.code-select name="departmentCode" id="departmentCode" codeKey="departmentCode"
                            :value="$request->departmentCode">部署選択</x-flowbite.codeSelect>
                            <x-flowbite.input type="text" name="staffCode" id="staffCode" :value="$request->staffCode">社員コード
                            </x-flowbite.input>
                            <x-flowbite.input type="text" name="staffName" id="staffName" :value="$request->staffName">社員名
                            </x-flowbite.input>
                            <button type="submit"
                                class="mt-2 text-white bg-gradient-to-r from-purple-500 to-pink-500 hover:bg-gradient-to-l focus:ring-4 focus:outline-none focus:ring-purple-200 dark:focus:ring-purple-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2">検索</button>
                    </div>
                </form>

                @if (isset($searchDatas))

                    <table class="w-full text-left text-sm text-gray-600 dark:text-gray-400">
                        <thead class="bg-gray-50 text-xs uppercase text-gray-700 dark:bg-gray-700 dark:text-gray-200">
                            <tr>
                                <th scope="col" class="py-3 px-1">
                                    社員コード
                                </th>
                                <th scope="col" class="py-3 px-1">
                                    社員名
                                </th>
                                <th scope="col" class="py-3 px-1">
                                    社員名カナ
                                </th>
                                <th scope="col" class="py-3 px-1">
                                    mail
                                </th>
                            </tr>
                        </thead>
                        @foreach ($searchDatas as $data)
                            <tbody>
                                <tr class="border-b bg-white dark:border-gray-700 dark:bg-gray-800">
                                    <th scope="row"
                                        class="whitespace-nowrap py-4 px-1 font-medium text-gray-600 dark:text-white">
                                        {{ $data->staffCode }}
                                    </th>
                                    <td class="py-3 px-1">
                                        {{ $data->staffName }}
                                    </td>
                                    <td class="py-4 px-1">
                                        {{ $data->staffNameKana }}
                                    </td>
                                    <td class="py-4 px-1">
                                        {{ $data->mail }}
                                    </td>
                                    <td>
                                        <x-flowbite.option-item route="manageapp.employee.select" svg="document" primaryKey="staffCode" :setPrimaryKey="$data->staffCode">照会</x-flowbite.option-item>
                                    </td>
                                    <td>
                                        <x-flowbite.option-item route="manageapp.employee.edit" svg="pencil-square" primaryKey="staffCode" :setPrimaryKey="$data->staffCode">編集</x-flowbite.option-item>
                                    </td>
                                    <td>
                                        <x-flowbite.option-item route="manageapp.employee.delete" svg="trash" primaryKey="staffCode" :setPrimaryKey="$data->staffCode">削除</x-flowbite.option-item>
                                    </td>

                                    {{-- javascript+Compornentでメニューボタンを設置する場合↓ --}}
                                    {{-- <td>
                                            <x-flowbite.options :staffCode="$data->staffCode">
                                            </x-flowbite.options>
                                        </td>
                                    --}}

                                </tr>
                            </tbody>
                        @endforeach
                    </table>
                    @if($searchDatas instanceof Illuminate\Pagination\LengthAwarePaginator)
                        {{ $searchDatas->appends(request()->query())->links() }}
                    @endif
                    @else
                @endif
            </main>
        </div>
    </div>
</body>

</html>
