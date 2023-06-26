<!DOCTYPE html>
<html lang="en">

<x-header title="～画面">
</x-header>

<body>

    <div class="container">
        <div class="row">
            @isset($title)
                <span class="self-center whitespace-nowrap text-xl font-semibold dark:text-white">{{ $title }}</span>
            @endisset
            <div class="col-lg-12 margin-tb mr-60">
                <form class="mr-60">

                    <x-input gridcol="8" labelwidth="2" formwidth="3" label="はたけやま"></x-input>
                    <x-lrinput gridcol="8" labelwidth="2" formwidth="3" label="はたけやま" rightlabel="" leftlabel=""
                        margin="10"></x-lrinput>


                    <button type="submit"
                        class="w-full rounded-lg bg-blue-700 px-5 py-2.5 text-center text-sm font-medium text-white hover:bg-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 sm:w-auto">Submit</button>
                </form>
            </div>

        </div>
    </div>
</body>

</html>
