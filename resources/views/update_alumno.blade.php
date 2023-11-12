<!DOCTYPE html>
<html lang="en">
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Actualización de datos</title>
</head>
<body>
    <div class="table-responsive">
    <table class="table table-primary">
        <thead>
            <tr>
                <th scope="col">Nombre</th>
                <th scope="col">Apellido</th>
                <th scope="col">Dni</th>
                <th scope="col">Teléfono</th>
                <th scope="col">Edad</th>
                <th scope="col">Nacimiento</th>
                <th scope="col">Tutor</th>
                <th scope="col">Curso</th>
                <th scope="col">División</th>

            </tr>
        </thead>
        <tbody>
            <form action="{{ route('update_alumno') }}" method="get">
                @csrf
                <tr class="">
                    @foreach($alumno as $alumno)
                    <input type="hidden" name="id" value="{{ $alumno->id }}">
                    <td scope="row"><input type="text" name="nombre_a" value="{{$alumno->nombre}}"></td>
                    <td><input type="text" name="apellido_a" value="{{$alumno->apellido}}"></td>
                    <td><input type="number" name="dni_a" value="{{$alumno->dni}}"></td>
                    <td><input type="number" name="telefono_a" value="{{$alumno->telefono}}"></td>
                    <td><input type="timestamp" name="nacimiento_a" value="{{$alumno->nacimiento}}"></td>
                    <td>{{ $alumno->tutor }}</td>
                    <td><input type="number" name="curso_a"></td>
                    <td><input type="number" name="division_a"></td>
                </tr>
            @endforeach

            <input type="submit" value="Enviar">
        </form>
        </tbody>
    </table>
    </div>
    <script src="https://kit.fontawesome.com/9fe70282e1.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
</body>
</html>
