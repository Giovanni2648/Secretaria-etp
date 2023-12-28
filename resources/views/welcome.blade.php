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
                <button type="button" class="btn nav-link active" data-bs-toggle="modal" data-bs-target="#modal_t">
                    Insertar Tutor
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
    @if ($errors->tutor->any())
        <div class="alert alert-danger">
            <ul>
                <h3>Error al insertar el Tutor en el registro</h3>
            </ul>
        </div>
    @endif
    @if ($errors->usuario->any())
        <div class="alert alert-danger">
            <ul>
                <h3>Error al insertar el Alumno en el registro</h3>
            </ul>
        </div>
    @endif
    @if ($errors->profesor->any())
        <div class="alert alert-danger">
            <ul>
                <h3>Error al insertar el Profesor en el registro</h3>
            </ul>
        </div>
    @endif
    <div>

    @include("crear_usuario")
    
    @include("crear_tutor")

    @include("crear_profesor")
   
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
