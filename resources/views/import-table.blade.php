<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Implementación Nemax</title>
    <!-- js y sass vite -->
    @vite('resources/js/app.js')
    @vite('resources/sass/app.scss')
</head>

<body>
    @yield('content')

    <nav class="navbar navbar-expand-md navbar-dark bg-primary">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Implementación Nemax</a>
        </div>
    </nav>
    <div class="container">
        <div class="card-container">
            <div class="card">
                <p class="instructions">INSTRUCCIONES:</p>
                <p>Seleccione la columna a modificar y elija una de las opciones disponibles.</p>
            </div>
            <div class="card">
                <!-- Nav tabs -->
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="false">Familias</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="messages-tab" data-bs-toggle="tab" data-bs-target="#messages" type="button" role="tab" aria-controls="messages" aria-selected="false">Alumnos</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="settings-tab" data-bs-toggle="tab" data-bs-target="#settings" type="button" role="tab" aria-controls="settings" aria-selected="false">Personas</button>
                    </li>
                </ul>
                <!-- Tab panes -->
                <div class="tab-content">
                    <div class="tab-pane active" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                        <button class="btn btn-info create-families" type="submit">Crear familia</button>
                        <button class="btn btn-primary separate-last-name" type="submit">Separar apellidos</button>
                        <button class="btn btn-primary separate-address" type="submit">Separar dirección</button>
                        <button class="btn btn-primary format-mm" type="submit">Formato May/Min</button>
                        <button class="btn btn-primary add-stateid" type="submit">Asignar ID Estado</button>
                        <button class="btn btn-primary add-countryid" type="submit">Asignar ID País</button>
                        <button class="btn btn-primary validate-phone" type="submit">Validar Teléfono</button>
                        <button class="btn btn-success export-docs" type="submit">Exportar</button>
                    </div>
                    <div class="tab-pane" id="messages" role="tabpanel" aria-labelledby="messages-tab">
                        <button class="btn btn-info separate-full-name" type="submit">Crear alumno</button>
                        <button class="btn btn-primary separate-full-name" type="submit">Separar Nombre completo</button>
                        <button class="btn btn-primary get-gender" type="submit">Obtener Genero</button>
                        <button class="btn btn-primary get-marital-status" type="submit">Obtener estatus marital</button>
                        <button class="btn btn-primary validate-curp" type="submit">Validar CURP</button>
                        <button class="btn btn-primary get-birth-date" type="submit">Obtener Fecha de Nacimiento</button>
                        <button class="btn btn-primary add-place-id" type="submit">Asignar ID Lugar de Nacimiento</button>
                        <button class="btn btn-primary add-nationality-id" type="submit">Asignar ID Nacionalidad</button>
                        <button class="btn btn-primary add-religion-id" type="submit">Asignar ID Religión</button>
                        <button class="btn btn-primary validate-phone" type="submit">Validar Teléfono</button>
                        <button class="btn btn-primary validate-emails" type="submit">Validar Correos</button>
                        <button class="btn btn-success export-docs" type="submit">Exportar</button>
                    </div>
                    <div class="tab-pane" id="settings" role="tabpanel" aria-labelledby="settings-tab">
                        <button class="btn btn-primary create-person" type="submit">Crear Persona</button>
                        <button class="btn btn-primary validate-gender" type="submit">Validar Género</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @if(isset($data) && !empty($data))
    <!-- Lista para vista móvil -->
    <div class="list-container">
        <label for="column-select">Seleccionar columna:</label>
        <select id="column-select" class="form-select">
            <!-- Opciones para seleccionar la columna -->
            @foreach(json_decode($data->first()->data, true) as $key => $value)
            <option value="{{ $key }}">{{ $key }}</option>
            @endforeach
        </select>
        @foreach($data as $row)
        <div class="list-item">
            <label><strong>ID:</strong></label> {{ $row->id }}<br>
            <!-- Datos de la fila -->
            @foreach(json_decode($row->data, true) as $key => $value)
            <label><strong>{{ $key }}:</strong></label> {{ $value }}<br>
            @endforeach
        </div>
        @endforeach
    </div>

    <!-- Tabla para vista de escritorio -->
    <div class="table-wrapper">
    <table class="table table-primary table-striped table-hover">
        <thead>
            <tr>
                <th>
                    <label class="form-check-label">
                        <input type="checkbox" class="form-check-input select-all" /></label>ID
                </th>
                <!-- Encabezados de las columnas -->
                @foreach(json_decode($data->first()->data, true) as $key => $value)
                <th>
                    <label class="form-check-label">
                        <input type="checkbox" class="form-check-input select-all" /> {{ $key }}
                    </label>
                </th>
                @endforeach
            </tr>
        </thead>
        <tbody>
            <!-- Filas de datos -->
            @foreach($data as $row)



            <tr>
                <td class="selectable-column">{{ $row->id }}</td>
                @foreach(json_decode($row->data, true) as $value)
                <td class="selectable-column">{{ $value }}</td>
                @endforeach
            </tr>
            @endforeach
        </tbody>
    </table>
    </div>
    @endif

    <div class="alert-container" id="alert-container"></div>


</body>

</html>