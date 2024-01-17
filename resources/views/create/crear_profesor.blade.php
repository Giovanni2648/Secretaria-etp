 <div>
    @if ($errors->profesor->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->profesor->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <button type="button" class="btn btn-dark m-3 p-3" data-bs-toggle="modal" data-bs-target="#modal_crear_profesor">Registrar Profesor</button>
    <form action="{{ route('store-profesor') }}" class="row g-3" method="post">
    @csrf
        <div class="modal fade" id="modal_crear_profesor" tabindex="-1">
            <div class="modal-dialog modal-lg modal-dialog-scrollable">
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
                                    <h2 class="row justify-content-center p-2 bg-dark text-light">PROFESOR</h2>
                                
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
                                
                                <h2 class="row justify-content-center p-2 bg-dark text-light">CURSO Y DIVISIÓN</h2>
                                <button type="button" class="curso" onclick="input()">Añadir curso</button>
                            
                                <div class="row">
                                    
                                    <div class="col-md-6">
                                        <input type="number" class="form-control" name="curso_p[]" placeholder="Curso">
                                    </div>
                                   
                                    <div class="col-md-6">
                                        <input type="number" class="form-control" name="division_p[]" placeholder="División">
                                    </div>
                                </div>
                                <div class="row" id="inputs-container"> </div>
                                    
                                    <script>
                                        $(document).ready(function() {
                                            $('.curso').click(function() {
                                                // Generar un nuevo input
                                                var newInput = $('<div class="col-md-6"><input type="number" class="form-control" name="curso_p[]" placeholder="Curso"></div>');
                                                var newInput2 = $('<div class="col-md-6"><input type="number" class="form-control" name="division_p[]" placeholder="División"></div>');

                                                // Agregar el input al contenedor
                                                $('#inputs-container').append(newInput);
                                                $('#inputs-container').append(newInput2);
                                            });
                                        });
                                    </script>
                                
                                <div class="row">
                                    <h2 class="row justify-content-center p-2 bg-dark text-light">TITULOS</h2>
                                    
                                    <div class="col-md-6">
                                        <button type="button" class="titulo" onclick="input()">Añadir Titulo</button>
                                        <input type="text" class="form-control" name="titulo[]" placeholder="Titulo">
                                        
                                        <div id="input-container"></div>
                                        
                                        <script>
                                            $(document).ready(function() {
                                                $('.titulo').click(function() {
                                                    // Generar un nuevo input
                                                    var newInput = $('<input type="text" class="form-control" name="titulo[]" placeholder="Titulo"/>');
                                                    $('#input-container').append(newInput);
                                                });
                                            });
                                        </script>
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <h2 class="row justify-content-center p-2 bg-dark text-light">MATERIAS</h2>
                                    
                                    <div id="datos_profesores">
                                        @foreach ($materias as $m)
                                            <input type="checkbox" name="materias_p[]" value="{{$m->id}}">
                                            <label for="materias_p">{{$m->materia}}</label><br>
                                        @endforeach
                                    </div>
                                    
                                    <div id="paginacion">
                                        {{ $materias->links() }}
                                    </div>
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