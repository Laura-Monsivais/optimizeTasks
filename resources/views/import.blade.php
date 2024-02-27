<!-- @if(session('success'))
    <div>{{ session('success') }}</div>
@endif

@if(isset($importedData))
    <div>Los siguientes datos se han importado:</div>
    <ul>
        @foreach($importedData as $data)
            <li>{{ $data }}</li>
        @endforeach
    </ul>
@endif

@if(session('error'))
    <div>{{ session('error') }}</div>
@endif
 -->
<form action="{{ route('uploadImport') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <input type="file" name="excel_file">
    <button type="submit">Importar</button>
</form>
