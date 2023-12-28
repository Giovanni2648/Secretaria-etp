<div id="alumnos bg-transparent">
<br>
<form action="{{ route('store-alumno') }}" method="post">
    @csrf

</div>
<div class="modal" tabindex="-1">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
          <h5 class="modal-title">Fomulario alumnos</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
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
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary">Save changes</button>
        </div>
      </div>
    </div>
  </div>
</form>
