<x-layouts.app>
        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <h1 class="row m-3 justify-content-center bg-dark text-light">Actualizar Datos del Alumno</h1>
    <form action="{{ route('update_alumno') }}" method="get">
        @csrf
        <div class="container">
            @foreach($alumnos as $alumno)
                <div class="row">
                    <input class="form-control" type="hidden" name="id" value="{{ $alumno->id }}">
                    <div class="col-6">
                        <label for="">Nombre</label>
                        <input class="form-control" type="text" name="nombre" value="{{$alumno->nombre}}">
                    </div>
                    <div class="col-6">
                        <label for="">Apellido</label>
                        <input class="form-control" type="text" name="apellido" value="{{$alumno->apellido}}">
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <label for="">Número de Documento</label>
                        <input class="form-control" type="number" name="dni" value="{{$alumno->dni}}">
                    </div>
                    <div class="col-6">
                        <label for="">Número de Teléfono</label>
                        <input class="form-control" type="number" name="telefono" value="{{$alumno->telefono}}">
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <label for="">Fecha de Nacimiento</label>
                        <input class="form-control" type="timestamp" name="nacimiento" value="{{$alumno->nacimiento}}">
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <label for="">Nombre del Tutor</label>
                        <input type="text" value="{{ $alumno->tutor }}" class="form-control" disabled>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <label for="">Curso</label>
                        <input class="form-control" type="number" name="curso" value="{{ $cursos }}">
                    </div>
                    <div class="col-6">
                        <label for="">División</label>
                        <input class="form-control" type="number" name="division" value="{{ $divisiones }}">
                    </div>
                </div>
            @endforeach
            <input class="form-control" type="submit" value="Enviar">
        </div>

    </form>
</x-layouts.app>