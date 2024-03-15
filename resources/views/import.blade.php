<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Implementación Nemax</title>
    @vite('resources/js/app.js')
    @vite('resources/sass/app.scss')
</head>
<body>
    @yield('content')
    <div class="title-container">
        <div class="row">
            <div class="col-md-6">
                <h1>Implementación Nemax</h1>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="card-container">
            <div class="card">
                <p class="instructions">INSTRUCCIONES:</p>
                <p>Agregue el archivo completo sobre los datos a implementar del colegio.</p>
            </div>
            <div class="card">
                <p class="notes">NOTA:</p>
                <p>En caso de que los archivos vengan separados, unir todos en uno solo.</p>
            </div>
        </div>
        <form action="{{ route('uploadImport') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="file" name="excel_file">
            <button class="btn btn-primary" type="submit">Importar</button>
        </form>
    </div>
</body>
</html>
