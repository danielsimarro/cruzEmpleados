
@extends('base')

@section('content')
<h1>Subir imagen a un trabajador</h1>
@if(Session::has('message'))
    <div class="alert alert-{{ session()->get('type') }}" role="alert">
        {{ session()->get('message') }}
    </div>
@endif

<form action="{{ url('imagen') }}" method="post">
    @csrf
    
    <div class="form-group">
        <label for="trabajador">Selecciona el trabajador al cual se quiere subir la imagen</label>
    <select name="idtrabajador" id="trabajador" class="form-control" required>
        <option selected disabled value="">&nbsp</option>
         @foreach ($trabajadores as $trabajador)
            <option value="{{ $trabajador->id}}">{{ $trabajador->id }} {{ $trabajador->nombre }}  {{ $trabajador->apellido }}</option>
        @endforeach
    </select>
    </div>
    @error('idtrabajador')
    <div class="alert alert-danger">{{ $message }}</div>
    @enderror
    
    
     <div class="form-group row">
     <label for="nombre" class="col-sm-2 col-form-label">Nombre del archivo</label>
    <div class="col-sm-2">
      <input value="{{ old('nombre') }}" type="text" name="nombre" placeholder="Introduce el nombre" id="nombre" minlength="2" maxlength="100" required class="form-control-plaintext">
    </div>
    @error('nombre')
    <div class="alert alert-danger">{{ $message }}</div>
    @enderror
    
    <div class="form-group row">
     <label for="mimetype" class="col-sm-2 col-form-label">Tipo de archivo</label>
    <div class="col-sm-10">
      <input value="{{ old('mimetype') }}" type="text" name="mimetype" placeholder="Introduce el tipo de archivo" id="mimetype" minlength="2" maxlength="20" required class="form-control-plaintext">
    </div>
    @error('mimetype')
    <div class="alert alert-danger">{{ $message }}</div>
    @enderror
    
    
    <input id="enviar" type="submit" value="Crear imagen" class="btn btn-success"/>
</form>

<a href="{{ url('imagen') }}" class="btn btn-secondary" id="volver">Volver</a>

@endsection