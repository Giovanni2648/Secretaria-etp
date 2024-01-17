{{-- Print Profesores --}}
    <h2 class="row p-3 justify-content-center text-white">PROFESORES</h2
    <div class="table-responsive">
        <form action="{{ route('buscador-profesores') }}" method="get">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-3">
                        <input type="search" class="m-2 form-control" name="buscador_nombre" placeholder="Nombre del Profesor">
                    </div>
                    
                    <div class="col-3">
                        <input type="search" class="m-2 form-control" name="buscador_apellido" placeholder="Apellido del Profesor">
                    </div>
                    
                    <div class="m-2 col-1">
                        <input class="btn btn-success" type="submit" value="Enviar">
                        @if (isset($nombre_ruta) && $nombre_ruta == "buscador-profesores")
                            <a href="{{route("dashboard-profesores")}}" class="btn btn-dark mt-1"><i class="fa-solid fa-refresh"></i></a>
                        @endif
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
                    <td><a href="{{ route("show_update_profesor", ['id' => $profesor->id]) }}"><i class="fa-solid fa-pen text-dark"></i></a></td>
                    <td><a href="{{ route("delete_profesor", ['id' => $profesor->id]) }}"><i class="fa-solid fa-trash text-dark"></i></a></td>
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