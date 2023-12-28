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
                        @if ($errors->usuario->any())
                        <div class="alert alert-danger">
                            <ul>
                               @foreach ($errors->usuario->all() as $error)
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