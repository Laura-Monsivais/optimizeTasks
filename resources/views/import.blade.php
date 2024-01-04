<!-- resources/views/import.blade.php -->

@if(session('success'))
    <div>{{ session('success') }}</div>
@endif

<form action="{{ route('import') }}" method="GET">
    @csrf
    <input type="file" name="excel_file">
    <button type="submit">Importar</button>
</form>


@if(isset($data))
    <h2>Datos Importados:</h2>
    <table border="1">
        <thead>
            <!-- Encabezados de la tabla -->
        </thead>
        <tbody>
            @foreach($data as $row)
                <tr>
                    <!-- Contenido de la tabla -->
                </tr>
            @endforeach
        </tbody>
    </table>
@endif
