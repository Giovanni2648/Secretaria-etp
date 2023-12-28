<!DOCTYPE html>
<html lang="en">
<head>
    {{-- Bootstrap --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.6.4.js" integrity="sha256-a9jBBRygX1Bh5lt8GZjXDzyOB+bWve9EiO7tROUtj/E=" crossorigin="anonymous"></script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Secretaria ETP</title>
    <style>
        table
        {
            background-color: rgba(183, 72, 76, 0.7);
        }
        h2
        {
            background-color: rgb(95,2,31);
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
          <a class="navbar-brand" href="#">Inicio</a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
              <li class="nav-item">
                <button type="button" class="btn nav-link active" data-bs-toggle="modal" data-bs-target="#modal_a">
                    Insertar alumno
                  </button>
              </li>
              <li class="nav-item">
                <button type="button" class="btn nav-link active" data-bs-toggle="modal" data-bs-target="#modal_p">
                    Insertar Profesor
                  </button>
              </li>
            </ul>
          </div>
        </div>
      </nav>
    <br>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                <h3>Error al insertar el registro</h3>
            </ul>
        </div>
    @endif
    <div>
        <form action="{{ route('store-alumno') }}" method="post">
            @csrf
        <div class="modal fade" id="modal_a" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Fomulario alumnos</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="container">
                        @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                        <div class="row">
                            <h2 class="row justify-content-center p-2 text-light">ALUMNO</h2>
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
                        <h2 class="row justify-content-center p-2 text-light">CURSO  Y DIVISIÓN</h2>
                        <div class="row">
                            <div class="col-6">
                                <input type="number" class="form-control" name="curso" placeholder="Curso">
                            </div>
                            <div class="col-6">
                                <input type="number" class="form-control" name="division" placeholder="División">
                            </div>

                        </div>
                        <h2 class="row justify-content-center p-2 text-light">TUTOR</h2>
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


                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                    <div class="col-2"><input type="submit" class="form-control" value="Enviar"></div>
                </div>
                </div>
            </div>
            </div>
        </form>

    </div>

    <div>
        <form action="{{ route('store-profesor') }}" class="row g-3" method="post">
            @csrf
            @method('POST')
        <div class="modal fade" id="modal_p" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">FORMULARIO DE PROFESORES</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="container">
                        @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                        @endif
                        <div class="container">
                            <div class="row">
                                <h2 class="row justify-content-center p-2 text-light">PROFESOR</h2>
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
                                    <h2 class="row justify-content-center p-2 text-light">CURSO Y DIVISIÓN</h2>
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
                                        <h2 class="row justify-content-center p-2 text-light">TÍTULOS</h2>
                                        <input type="text" name="titulo_p1" class="form-control" placeholder="Título 1 (Obligatorio)">
                                        <input type="text" name="titulo_p2" class="form-control" placeholder="Título 2 (Opcional)">
                                        <input type="text" name="titulo_p3" class="form-control" placeholder="Título 3 (Opcional)">
                                        <input type="text" name="titulo_p4" class="form-control" placeholder="Título 4 (Opcional)">
                                        <input type="text" name="titulo_p5" class="form-control" placeholder="Título 5 (Opcional)">
                                </div>
                                <h2 class="row justify-content-center p-2 text-light">MATERIAS</h2>
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
                </div>
            </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                    <div class="col-2"><input type="submit" class="form-control" value="Enviar"></div>
                </div>
                </div>
            </div>
            </div>
        </form>

    </div>
    {{-- Print alumnos  --}}
    <h2 class="row justify-content-center p-2 text-light">ALUMNOS</h2>
    <div class="table-responsive">

        <form action="{{ route('buscador') }}" method="get">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-3">
                        <input type="search" class="m-2 form-control" name="buscador_alumno_nombre" placeholder="Nombre del Alumno">
                    </div>
                    <div class="col-3">
                        <input type="search" class="m-2 form-control" name="buscador_alumno_apellido" placeholder="Apellido del Alumno">
                    </div>
                    <div class="col-2">
                        <input type="search" class="m-2 form-control" name="buscador_alumno_curso" placeholder="Curso del Alumno">
                    </div>
                    <div class="col-2">
                        <input type="search" class="m-2 form-control" name="buscador_alumno_division" placeholder="División del Alumno">
                    </div>
                    <div class="m-2 col"><input type="submit" value="Enviar"></div>

                </div>
            </div>
        </form>

        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Nombre</th>
                    <th scope="col">Apellido</th>
                    <th scope="col">Dni</th>
                    <th scope="col">Teléfono</th>
                    <th scope="col">Nacimiento</th>
                    <th scope="col">Tutor</th>
                    <th scope="col">Curso</th>
                    <th scope="col"></th>
                    <th scope="col"></th>

                </tr>
            </thead>
            <tbody>
                <tr class="">
                    @forelse($alumnos as $alumno)
                    <td scope="row">{{$alumno->nombre}}</td>
                    <td>{{$alumno->apellido}}</td>
                    <td>{{$alumno->dni}}</td>
                    <td>{{$alumno->telefono}}</td>
                    <td>{{$alumno->nacimiento}}</td>
                    <td>{{$alumno->tutor}}</td>
                    <td>{{$alumno->cursos}}</td>
                    <td scope="col"><a href="{{ route('show_update_alumno', ['id'=>$alumno->id]) }}"><i class="fa-solid fa-pen"></a></i></td>
                    <input type="hidden" name="id" value="{{$alumno->id}}">
                    <td><a href="{{ route('delete_alumno', ['id'=>$alumno->id]) }}"><i class="fa-sharp fa-solid fa-trash"></i></a></td>
                </tr>
                @empty
                    <tr>
                        <td>No hay Registros</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
                {{$alumnos->links()}}
    </div>


    {{-- Print Tutores --}}
    <h2 class="row p-3 justify-content-center text-white">TUTORES</h2
    <div class="table-responsive">
        <form action="{{ route('buscador') }}" method="get">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-4">
                        <input type="search" class="m-2 form-control" name="buscador_nombre_tutor" placeholder="Nombre del Tutor">
                    </div>
                    <div class="col-4">
                        <input type="search" class="m-2 form-control" name="buscador_apellido_tutor" placeholder="Apellido del Tutor">
                    </div>
                    <div class="m-2 col"><input type="submit" value="Enviar"></div>
                </div>
            </div>
        </form>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Nombre</th>
                    <th scope="col">Apellido</th>
                    <th scope="col">Dni</th>
                    <th scope="col">Teléfono</th>
                    <th scope="col"></th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody>
                <tr class="">
            @forelse($tutor as $tut)
                    <td scope="row">{{$tut->nombre}}</td>
                    <td>{{$tut->apellido}}</td>
                    <td>{{$tut->dni}}</td>
                    <td>{{$tut->telefono}}</td>
                    <td scope="col"><a href="{{ route('show_update_tutor', ['id'=>$tut->id]) }}"><i class="fa-solid fa-pen"></a></i></td>

                    <input type="hidden" name="id" value="{{$tut->id}}">
                    <td><a href="{{ route('delete_tutor', ['id'=>$tut->id]) }}"><i class="fa-sharp fa-solid fa-trash"></i></a></td>
                </tr>

                @empty
                    <tr>
                        <td>No hay Registros</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                @endforelse
            </tbody>
        </table>
                {{$tutor->links()}}
        </div>
    </div>

    {{-- Print Profesores --}}
    <h2 class="row p-3 justify-content-center text-white">PROFESORES</h2
    <div class="table-responsive">
        <form action="{{ route('buscador') }}" method="get">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-4">
                        <input type="search" class="m-2 form-control" name="buscador_profesor_nombre" placeholder="Nombre del Profesor">
                    </div>
                    <div class="col-4">
                        <input type="search" class="m-2 form-control" name="buscador_profesor_apellido" placeholder="Apellido del Profesor">
                    </div>
                    <div class="m-2 col"><input type="submit" value="Enviar"></div>
                </div>
            </div>
        </form>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Nombre</th>
                    <th scope="col">Apellido</th>
                    <th scope="col">Dni</th>
                    <th scope="col">Teléfono</th>
                    <th scope="col"></th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody>
                <tr class="">
            @forelse($profesores as $profesor)
                    <td scope="row">{{$profesor->nombre}}</td>
                    <td>{{$profesor->apellido}}</td>
                    <td>{{$profesor->dni}}</td>
                    <td>{{$profesor->telefono}}</td>
                    <td scope="col"><a href="{{ route('show_update_profesor', ['id'=>$profesor->id]) }}"><i class="fa-solid fa-pen"></a></i></td>
                    <input type="hidden" name="id" value="{{$profesor->id}}">
                    <td><a href="{{ route('delete_profesor', ['id'=>$profesor->id]) }}"><i class="fa-sharp fa-solid fa-trash"></i></a></td>
                </tr>
                @empty
                    <tr>
                        <td>No hay Registros</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>

            @endforelse
            </tbody>
        </table>
    </div>
                {{$profesores->links()}}

    <script src="https://kit.fontawesome.com/9fe70282e1.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
</body>
</html>
