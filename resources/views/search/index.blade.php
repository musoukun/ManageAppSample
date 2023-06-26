<!-- resources/views/search/index.blade.php -->

<!DOCTYPE html>
<html>

<head>
    <title>Data Search Tool</title>
</head>

<body>
    <h1>Data Search Tool</h1>

    <form method="post" action="/search">
        @csrf

        <h3>Select Table:</h3>
        <select name="selectTable">
            @foreach ($tables as $table)
                <option value="{{ $table }}" @if ($table == $selectTable) selected @endif>{{ $table }}
                </option>
            @endforeach
        </select>

        <button type="submit">Display</button>
    </form>

    @if (isset($getColumns))
        <h3>Select Columns:</h3>
        <form method="post" action="/search/results">
            @csrf
            @foreach ($getColumns as $column)
                <label><input type="checkbox" name="columns[]" value="{{ $column }}">
                    {{ $column }}</label><br>
            @endforeach

            <button type="submit">Search</button>
        </form>
    @endif
</body>

</html>
