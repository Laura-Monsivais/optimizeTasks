<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Implementación Nemax</title>
    <!-- Agrega el CSS de Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>

<body>
    <!-- Contenido de tu aplicación -->
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
                <p>Seleccione la columna a modificar y elija una de las opciones disponibles.</p>
            </div>
            <div class="card">
                <!-- Nav tabs -->
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Familias</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="messages-tab" data-toggle="tab" href="#messages" role="tab" aria-controls="messages" aria-selected="false">Alumnos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="settings-tab" data-toggle="tab" href="#settings" role="tab" aria-controls="settings" aria-selected="false">Personas</a>
                    </li>
                </ul>

                <!-- Tab panes -->
                <div class="tab-content">
                    <div class="tab-pane" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                        <button class="btn btn-primary separate-last-name" type="submit">Separar apellidos</button>
                        <button class="btn btn-primary separate-address" type="submit">Separar Dirección</button>
                    </div>
                    <div class="tab-pane" id="messages" role="tabpanel" aria-labelledby="messages-tab">
                        <button class="btn btn-primary separate-full-name" type="submit">Separar Nombre completo</button>
                        <button class="btn btn-primary validate-curp" type="submit">Validar CURP</button>
                    </div>
                    <div class="tab-pane" id="settings" role="tabpanel" aria-labelledby="settings-tab">
                        <button class="btn btn-primary create-person" type="submit">Crear Persona</button>
                        <button class="btn btn-primary validate-gender" type="submit">Validar Género</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @if(isset($data) && $data->isNotEmpty())
    <table class="table">
        <thead>
            <tr>
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
                @foreach(json_decode($row->data, true) as $value)
                <td class="selectable-column">{{ $value }}</td>
                @endforeach
            </tr>
            @endforeach
        </tbody>
    </table>
    @endif
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
    <script>
        $(document).ready(function() {
            $('th').click(function() {
                var columnIndex = $(this).index();
                $('tr').each(function() {
                    var $cell = $(this).find('td').eq(columnIndex);
                    $cell.toggleClass('selected');
                });
            });

            $('.select-all').click(function() {
                var columnIndex = $(this).closest('th').index();
                $('tr').each(function() {
                    var $cell = $(this).find('td').eq(columnIndex);
                    $cell.toggleClass('selected', $(this).prop('checked'));
                });
            });

            $('.separate-last-name, .separate-address, .separate-full-name, .validate-curp, .create-person, .validate-gender').click(function() {
                var columnIndex = $('th input:checked').closest('th').index();
                var url = $(this).hasClass('separate-last-name') ? '/families/separateSurnames' :
                    $(this).hasClass('separate-address') ? '/families/separateAddress' :
                    $(this).hasClass('separate-full-name') ? '/students/separateFullName' :
                    $(this).hasClass('validate-curp') ? '/families/validateCurp' :
                    $(this).hasClass('create-person') ? '/students/create' :
                    $(this).hasClass('validate-gender') ? '/persons/validateGender' : '';

                sendData(url, columnIndex);
            });

            function sendData(url, columnIndex) {
                var columnData = [];
                $('tr').each(function() {
                    var $cell = $(this).find('td').eq(columnIndex);
                    columnData.push($cell.text());
                });

                if (columnData.length > 0) {
                    $.ajax({
                        url: url,
                        method: 'POST',
                        data: {
                            columnData: columnData
                        },
                        success: function(response) {
                            if (url === '/families/separateSurnames') {
                                alert('Apellido Paterno: ' + response.paternalSurnames.join(', ') + '\nApellido Materno: ' + response.maternalSurnames.join(', '));
                            } else if (url === '/families/separateAddress') {

                            } else if (url === '/families/separateFullName') {} else if (url === '/families/validateCurp') {} else if (url === '/families/createPerson') {} else if (url === '/families/validateGender') {}
                        },
                        error: function(xhr, status, error) {
                            console.error(error);
                        }
                    });
                } else {
                    alert('No hay datos en la columna seleccionada.');
                }
            }
        });

        function checkForUpdates() {
        $.ajax({
            url: '/check-updates',
            type: 'GET',
            success: function(response) {
                if (response.changes) {
                    location.reload();
                }
            },
            error: function(xhr, status, error) {
                console.error(error);
            }
        });
    }

  $(document).ready(function() {
            checkForUpdates();
            setInterval(checkForUpdates, 
            30000);
        });
    </script>
</body>

</html>
