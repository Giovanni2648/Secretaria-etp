<div>
    {{-- Print Tutores --}}
    <h2 class="row p-3 justify-content-center text-white">TUTORES</h2>
        <form action="{{ route('buscador-tutores') }}" method="get">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-2">
                        <input type="search" class="m-2 form-control" name="buscador_nombre" placeholder="Nombre del Tutor">
                    </div>
                    <div class="col-2">
                        <input type="search" class="m-2 form-control" name="buscador_apellido" placeholder="Apellido del Tutor">
                    </div>
                    <div class="col-2">
                        <input type="search" class="m-2 form-control" name="buscador_dni" placeholder="DNI del Tutor">
                    </div>
                    <div class="m-2 col-1">
                        <input class="btn btn-success" type="submit" value="Enviar">
                        @if (isset($nombre_ruta) && $nombre_ruta == "buscador-tutores")
                            <a href="{{route("dashboard-tutores")}}" class="btn btn-dark mt-1"><i class="fa-solid fa-refresh"></i></a>
                        @endif
                    </div>
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
            @forelse($tutores as $tutor)
                    <td scope="row">{{$tutor->nombre}}</td>
                    <td>{{$tutor->apellido}}</td>
                    <td>{{$tutor->dni}}</td>
                    <td>{{$tutor->telefono}}</td>
                    <td><a href="{{ route("show_update_tutor", ['id' => $tutor->id]) }}"><i class="fa-solid fa-pen text-dark"></i></a></td>
                    <td><a href="{{ route("delete_tutor", ['id' => $tutor->id]) }}"><i class="fa-solid fa-trash text-dark"></i></a></td>
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
                {{$tutores->links()}}
        </div>
    </div>
</div>