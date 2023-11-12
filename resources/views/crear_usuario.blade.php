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

<div id="alumnos">
<br>
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<form action="{{ route('store-alumno') }}" method="post">
    @csrf
    <div class="container">
        <div class="row">
            <h2 class="bg-primary bg-gradient text-light">Alumno</h2>
            <div class="col-6">
                <input type="text" class="form-control" name="nombre" placeholder="Nombre">
            </div>
            <div class="col-6">
                <input type="text" class="form-control" name="apellido" placeholder="Apellido">
            </div>
        <div class="row">
            <div class="col-6">
                <input type="number" class="form-control" name="dni" placeholder="DNI">
            </div>

        </div>
        <div class="row">
            <div class="col-6">
                <input type="number" class="form-control" name="telefono" placeholder="Telefono">
            </div>
            <div class="col-6">
                <input type="date" class="form-control" name="nacimiento" placeholder="Fecha de Nacimiento">
            </div>

        </div>
        <h2 class="bg-primary bg-gradient text-light">Curso y División</h2>
        <div class="row">
            <div class="col-6">
                <input type="number" class="form-control" name="curso" placeholder="Curso">
            </div>
            <div class="col-6">
                <input type="number" class="form-control" name="division" placeholder="División">
            </div>

        </div>
        <h2 class="bg-primary bg-gradient text-light">Tutor</h2>
        <div class="row">
            <div class="col-6">
                <input type="text" class="form-control" name="nombre_t" placeholder="Nombre">
            </div>
            <div class="col-6">
                <input type="text" class="form-control" name="apellido_t" placeholder="Apellido">
            </div>

        </div>
        <div class="row">
            <div class="col-6">
                <input type="number" class="form-control" name="dni_t" placeholder="DNI">
            </div>
            <div class="col-6">
                <input type="number" class="form-control" name="telefono_t" placeholder="Telefono">
            </div>

        </div>
    </div>

    <div class="row">
        <div class="col-2"><input type="submit" class="form-control" value="Enviar"></div>
    </div>
</form>

</div>

</body>
</html>
