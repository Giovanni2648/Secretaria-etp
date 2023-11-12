<!DOCTYPE html>
<html lang="en">
<head>
    {{-- Bootstrap --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.6.4.js" integrity="sha256-a9jBBRygX1Bh5lt8GZjXDzyOB+bWve9EiO7tROUtj/E=" crossorigin="anonymous"></script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Example app</title>
</head>
<body>
<div id="profesores" class="container">
    <h1 class="bg-primary bg-gradient text-light">Formulario de Registro de Profesores</h1><br>
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
    <form action="{{ route('store-profesor') }}" class="row g-3" method="post">
        @csrf
        @method('POST')
        <div class="container">
            <div class="row">
                <div class="col-6">
                    <input type="text" class="form-control" name="nombre_p" placeholder="Nombre">
                </div>
                <div class="col-6">
                    <input type="text" class="form-control" name="apellido_p" placeholder="Apellido">
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <input type="number" class="form-control" name="dni_p" placeholder="DNI">
                </div>
                <div class="col-md-6">
                    <input type="number" class="form-control" name="telefono_p" placeholder="Telefono">
                </div>
            </div>
            <div class="row">
                <h2 class="bg-primary bg-gradient text-light">Curso y División</h2>
                <div class="col-md-6">
                    <button type="button" class="curso" onclick="input()">Añadir curso</button>
                    <input type="number" class="form-control" name="curso_p" placeholder="Curso">
                    <input type="number" class="form-control" name="division_p" placeholder="División">
                    <div id="inputs-container"> </div>
                    <script>
                        $(document).ready(function() {
                            $('.curso').click(function() {
                                // Generar un nuevo input
                                var newInput = $('<input type="number" class="form-control" name="curso_p" placeholder="Curso" />');
                                var newInput2 = $('<input type="number" class="form-control" name="division_p" placeholder="Division" />');

                                // Agregar el input al contenedor
                                $('#inputs-container').append(newInput);
                                $('#inputs-container').append(newInput2);
                            });
                        });

                    </script>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <h2 class="bg-primary bg-gradient text-light">Títulos</h2>
                    <input type="text" name="titulo_p1" class="form-control" placeholder="Título 1 (Obligatorio)">
                    <input type="text" name="titulo_p2" class="form-control" placeholder="Título 2 (Opcional)">
                    <input type="text" name="titulo_p3" class="form-control" placeholder="Título 3 (Opcional)">
                    <input type="text" name="titulo_p4" class="form-control" placeholder="Título 4 (Opcional)">
                    <input type="text" name="titulo_p5" class="form-control" placeholder="Título 5 (Opcional)">
            </div>
            <h2 class="bg-primary bg-gradient text-light">Materias</h2>
            <div>
                @forelse ($materias as $m)
                        <input type="checkbox" name="materias_p" value="{{$m->id}}">
                        <label for="materias_p">{{$m->materia}}</label><br>
                @empty
                    <h1>No se encontraron materias</h1>
                @endforelse
            </div>
            {{$materias->links()}}
        </div>
        <input type="submit" class="form-control" value="Enviar">
    </form>
</div>

</body>
</html>
