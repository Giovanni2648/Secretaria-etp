{{-- Print alumnos  --}}
    <h2 class="row justify-content-center p-2 text-light">ALUMNOS</h2>
    <div class="table-responsive">

        <form action="{{ route('buscador-alumnos') }}" method="get">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-2">
                        <input type="search" class="m-2 form-control" name="buscador_nombre" placeholder="Nombre del Alumno">
                    </div>
                    <div class="col-2">
                        <input type="search" class="m-2 form-control" name="buscador_apellido" placeholder="Apellido del Alumno">
                    </div>
                    <div class="col-2">
                        <input type="search" class="m-2 form-control" name="buscador_dni" placeholder="DNI del Alumno">
                    </div>
                    <div class="col-2">
                        <input type="search" class="m-2 form-control" name="buscador_curso" placeholder="Curso del Alumno">
                    </div>
                    <div class="col-2">
                        <input type="search" class="m-2 form-control" name="buscador_division" placeholder="División del Alumno">
                    </div>
                    <div class="m-2 col-1">
                        <input class="btn btn-success" type="submit" value="Enviar">
                        @if (isset($nombre_ruta) && $nombre_ruta == "buscador-alumnos")
                            <a href="{{route("dashboard-alumnos")}}" class="btn btn-dark mt-1"><i class="fa-solid fa-refresh"></i></a>
                        @endif
                    </div>
                </div>
            </div>
        </form>
        <div>
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
                    <div>
                        @forelse($alumnos as $alumno)
                            <td>{{ $alumno->nombre }}</td>
                            <td>{{ $alumno->apellido }}</td>
                            <td>{{ $alumno->dni }}</td>
                            <td>{{ $alumno->telefono }}</td>
                            <td>{{ $alumno->nacimiento }}</td>
                            <td>{{ $alumno->tutor }}</td>
                            <td>{{ $alumno->cursos }}</td>
                            <td><a href="{{ route("show_update_alumno", ['id' => $alumno->id]) }}"><i class="fa-solid fa-pen text-dark"></i></a></td>
                            <td><a href="{{ route("delete_alumno", ['id' => $alumno->id]) }}"><i class="fa-solid fa-trash text-dark"></i></a></td>
                        
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
                    </div>
                </tbody>
            </table>
                {{$alumnos->links()}}
        </div>
    </div>