<!-- resources/views/search/results.blade.php -->

<!DOCTYPE html>
<html>

<head>
    <title>Search Results</title>
    <style>
        table {
            border-collapse: collapse;
        }

        th,
        td {
            border: 1px solid black;
            padding: 5px;
        }
    </style>
</head>

<body>
    <h1>Search Results</h1>

    @if ($results->isEmpty())
        <p>No results found.</p>
    @else
        <table>
            <thead>
                <tr>
                    @foreach ($results[0] as $key => $value)
                        <th>{{ $key }}</th>
                    @endforeach
                </tr>
            </thead>
            <tbody>
                @foreach ($results as $result)
                    <tr>
                        @foreach ($result as $value)
                            <td>{{ $value }}</td>
                        @endforeach
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</body>

</html>
