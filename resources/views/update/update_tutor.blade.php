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
    <h1 class="row m-3 justify-content-center bg-dark text-light">Actualizar Datos del Tutor</h1>
    <form action="{{ route('update_tutor') }}" method="get">
        @csrf
        <div class="container">
            @foreach($tutores as $tutor)
                <div class="row">
                    <input class="form-control" type="hidden" name="id" value="{{ $tutor->id }}">
                    
                    <div class="col-6">
                        <label for="">Nombre</label>
                        <input class="form-control" type="text" name="nombre" value="{{$tutor->nombre}}">
                    </div>
                    
                    <div class="col-6">
                        <label for="">Apellido</label>
                        <input class="form-control" type="text" name="apellido" value="{{$tutor->apellido}}">
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <label for="">Número de Documento</label>
                        <input class="form-control" type="number" name="dni" value="{{$tutor->dni}}">
                    </div>
                    
                    <div class="col-6">
                        <label for="">Número de Teléfono</label>
                        <input class="form-control" type="number" name="telefono" value="{{$tutor->telefono}}">
                    </div>
                </div>
            @endforeach
            <input class="form-control" type="submit" value="Enviar">
        </div>
    </form>
</x-layouts.app>