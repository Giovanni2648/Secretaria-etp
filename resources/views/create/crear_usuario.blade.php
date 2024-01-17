<div>
    @if ($errors->usuario->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->usuario->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <!-- Button trigger modal -->
    <button type="button" class="btn btn-dark m-3 p-3" data-bs-toggle="modal" data-bs-target="#modal_crear_alumno">Registrar Alumno</button>

    <!-- Modal -->
    <div class="modal fade" id="modal_crear_alumno" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Formulario de Registro</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
            
                <div class="modal-body">
                    <form action="{{ route('store-alumno') }}" method="post">
                    @csrf
                        <input class="form-control" placeholder="Nombre" type="text" name="nombre">
                        <input class="form-control" placeholder="Apellido" type="text" name="apellido">
                        <input class="form-control" placeholder="DNI" type="number" name="dni">
                        <input class="form-control" placeholder="Telefono" type="number" name="telefono">
                        <input class="form-control" placeholder="Fecha de Nacimiento" type="date" name="nacimiento">
                        <input class="form-control" placeholder="Tutor" type="text" name="dni_t">
                        <input class="form-control" placeholder="Curso" type="number" name="curso">
                        <input class="form-control" placeholder="Division" type="number" name="division">
                </div>
            
                <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Guardar</button>
                </form>
                </div>
            </div>
        </div>
    </div>
</div>