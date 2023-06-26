<html>
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div id="app" class="p-5">
    <form method="GET">
        <div class="row">
            @if(!empty($database_names))
                <div class="col-md-6 mb-4">
                    <h1>データベース</h1>
                    <select id="database" class="form-control" name="target_db">
                        <option value="">▼ DB選択</option>
                        @foreach($database_names as $database_name)
                            <option value="{{ $database_name }}"
                                {{ ($database_name === $target_db) ? ' selected' : '' }}
                            >
                                {{ $database_name }}
                            </option>
                        @endforeach
                    </select>
                </div>
            @endif
            @if(!empty($table_names))
                <div class="col-md-6 mb-4">
                    <h1>テーブル</h1>
                    <select id="table" class="form-control" name="target_table">
                        <option value="">▼ Table選択</option>
                        @foreach($table_names as $table_name)
                            <option value="{{ $table_name }}"
                                {{ ($table_name === $target_table) ? ' selected' : '' }}
                            >
                                {{ $table_name }}
                            </option>
                        @endforeach
                    </select>
                    <label>
                        <input type="checkbox" name="with_comment" value="true"> コメントを付ける
                    </label>
                </div>
            @endif
            @if(!empty($columns))
                <div class="col-md-12">
                    <h1>コード</h1>
                </div>
                <div class="col-md-6 mb-4">
                    <h2>Create</h2>
                    <div class="bg-light p-3">
                    ${{ $target_table_singular }} = new \App\Models\{{ $target_table_studly }}();<br>
                    @foreach($columns as $column)
                        ${{ $target_table_singular }}->{{ $column->Field }} = $request->{{ $column->Field }};
                        @if(!empty($column->Field) && $with_comment === true)
                            // {{ $column->Field }}
                        @endif<br>
                    @endforeach
                    ${{ $target_table_singular }}->save();
                    </div>
                </div>
                <div class="col-md-6 mb-4">
                    <h2>Array in PHP</h2>
                    <div class="bg-light p-3">
                    ${{ $target_table_singular }} = [<br>
                    @foreach($columns as $column)
                        &nbsp;&nbsp;&nbsp;&nbsp;
                        '{{ $column->Field }}' => $request->{{ $column->Field }},
                        {{-- @if(!empty($column->Comment) && $with_comment === true)
                            // {{ $column->Comment }}
                        @endif --}}
                        <br>
                    @endforeach
                    ]
                    </div>
                </div>
                <div class="col-md-6 mb-4">
                    <h2>Object in JavaScript</h2>
                    <div class="bg-light p-3">
                    const {{ $target_table_camel }} = {
                    <br>
                    @foreach($columns as $column)
                        &nbsp;&nbsp;&nbsp;&nbsp;
                        {{ $column->Field }}: {{ $target_table_camel }}.{{ $column->Field }},
                        @if(!empty($column->Comment) && $with_comment === true)
                            // {{ $column->Comment }}
                        @endif
                        <br>
                    @endforeach
                    }
                    </div>
                </div>
                <div class="col-md-6 mb-4">
                    <h2>Inputs</h2>
                    <div class="bg-light p-3">
                        @foreach($columns as $column)
                            &lt;div class="mb-3"&gt;<br>
                            &nbsp;&nbsp;
                            {{-- &lt;label&gt;{{ $column->Comment ?: $column->Field }}&lt;/label&gt;<br> --}}
                            &nbsp;&nbsp;
                            &lt;input class="form-control" name="{{ $column->Field }}"&gt;<br>
                            &lt;/div&gt;<br><br>
                        @endforeach
                    </div>
                </div>
            @endif
            <div class="col-md-12">
                <button type="submit" class="btn btn-primary btn-lg mt-3">送信する</button>
                <a href="./auto_coder" class="btn btn-link">クリア</a>
            </div>
        </div>
    </form>
</div>
<script>

    window.onload = () => {

        document.querySelector('#database').addEventListener('change', () => {

            const table = document.querySelector('#table');

            if(table) {

                table.innerHTML = '';

            }

        });

    };

</script>
</body>
</html>
