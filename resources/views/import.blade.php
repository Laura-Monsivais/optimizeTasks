<!-- resources/views/import.blade.php -->

@if(session('success'))
    <div>{{ session('success') }}</div>
@endif

<form action="{{ route('uploadImport') }}" method="POST"  enctype="multipart/form-data">
    @csrf
    <input type="file" name="excel_file">
    <button type="submit">Importar</button>
</form>

