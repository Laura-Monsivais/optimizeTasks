<!-- resources/views/import.blade.php -->

@if(session('success'))
    <div>{{ session('success') }}</div>
@endif

<form action="{{ route('uploadImport') }}" method="POST"  enctype="multipart/form-data">
    @csrf
    <input type="file" name="excel_file">
    <button type="submit">Importar</button>
</form>

@if(isset($data) && count($data) > 0)
<table border="1">
    <thead>
        <tr>
            @foreach($data[0] as $key => $value)
                <th>{{ $key }}</th>
            @endforeach
        </tr>
    </thead>
    <tbody>
        @foreach($data as $row)
            <tr>
                @foreach($row as $value)
                    <td>{{ $value }}</td>
                @endforeach
            </tr>
        @endforeach
    </tbody>
</table>
@else
<p>No hay datos importados.</p>
@endif
