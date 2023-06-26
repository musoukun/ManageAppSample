@props([
    'labelwidth' => '1/4',
    'formwidth' => '1/6',
    'labelclass' => '',
])
<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <title></title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href="/css/app.css" rel="stylesheet">
    @vite('resources/js/app.js', 'resources/css/app.css')

    <nav class="rounded border-gray-200 bg-white px-2 py-0 dark:bg-gray-900 sm:px-4">
        <div class="container mx-auto flex flex-wrap items-center justify-between">
            <a href="" class="flex items-center">
                <img src="{{ asset('logo/Web-logos_transparent2.png') }}" class="w-32" alt="ManageAppLogo" />

            </a>

            <div class="hidden w-full items-center justify-between md:order-1 md:flex md:w-auto" id="mobile-menu-2">
                <ul
                    class="flex flex-col rounded-lg border-gray-100 bg-gray-50 p-4 dark:border-gray-700 dark:bg-gray-800 md:mt-0 md:flex-row md:space-x-8 md:bg-white md:text-sm md:font-medium md:dark:bg-gray-900">
                    <li>
                        <a href="#"
                            class="block rounded bg-blue-700 py-2 pl-3 pr-4 text-white dark:text-white md:bg-transparent md:p-0 md:text-blue-700"
                            aria-current="page">Home</a>
                    </li>
                    <li>
                        <a href="#"
                            class="block rounded py-2 pl-3 pr-4 text-gray-700 hover:bg-gray-100 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white md:p-0 md:hover:bg-transparent md:hover:text-blue-700 md:dark:hover:bg-transparent md:dark:hover:text-white">About</a>
                    </li>
                    <li>
                        <a href="#"
                            class="block rounded py-2 pl-3 pr-4 text-gray-700 hover:bg-gray-100 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white md:p-0 md:hover:bg-transparent md:hover:text-blue-700 md:dark:hover:bg-transparent md:dark:hover:text-white">Services</a>
                    </li>
                    <li>
                        <a href="#"
                            class="block rounded py-2 pl-3 pr-4 text-gray-700 hover:bg-gray-100 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white md:p-0 md:hover:bg-transparent md:hover:text-blue-700 md:dark:hover:bg-transparent md:dark:hover:text-white">Pricing</a>
                    </li>
                    <li>
                        <a href="#"
                            class="block rounded py-2 pl-3 pr-4 text-gray-700 hover:bg-gray-100 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white md:p-0 md:hover:bg-transparent md:hover:text-blue-700 md:dark:hover:bg-transparent md:dark:hover:text-white">Contact</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

</head>


<body>

    <div class="container mr-10">
        @isset($title)
            <span class="self-center whitespace-nowrap text-xl font-semibold dark:text-white">{{ $title }}</span>
        @endisset
        <div class="col-lg-13 margin-tb mr-10">
            <form class="mr-10">

                <x-input gridcol="8" labelwidth="2" formwidth="3" label="はたけやま"></x-input>
                <x-lrinput gridcol="8" labelwidth="2" formwidth="3" label="はたけやま" rightlabel="" leftlabel=""
                    margin="10"></x-lrinput>


                <button type="submit"
                    class="w-full rounded-lg bg-blue-700 px-5 py-2.5 text-center text-sm font-medium text-white hover:bg-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 sm:w-auto">Submit</button>
            </form>


        </div>
    </div>

</body>

</html>
