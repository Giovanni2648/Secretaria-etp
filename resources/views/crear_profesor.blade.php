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
                        @if ($errors->profesor->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->profesor->all() as $error)
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