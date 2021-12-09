@extends('base')

@section('content')
<h1>Edit de la tabla: {{ $puesto->nombre }}</h1>
@if(Session::has('texto'))
    <div class="alert alert-{{ session()->get('tipo') }}" role="alert">
        {{ session()->get('texto') }}
    </div>
@endif
<form action="{{ url('puesto/' . $puesto->id) }}" method="post">
    @csrf
    @method('put')
    <div class="form-group row">
     <label for="nombre" class="col-sm-2 col-form-label">Nombre del puesto</label>
    <div class="col-sm-2">
      <input value="{{ old('nombre',$puesto->nombre) }}" type="text" name="nombre" placeholder="Introduce el nombre" id="nombre" minlength="2" maxlength="40" required class="form-control-plaintext">
    </div>
    @error('nombre')
    <div class="alert alert-danger">{{ $message }}</div>
    @enderror
    
    <div class="form-group row">
     <label for="minimo" class="col-sm-2 col-form-label">Sueldo mínimo del puesto</label>
    <div class="col-sm-3">
      <input value="{{ old('minimo',$puesto->minimo) }}" type="number" name="minimo" placeholder="Introduce el mínimo sueldo" id="minimo" min="0.01" max="9999999.99" step="0.01" required class="form-control-plaintext">
    </div>
    @error('minimo')
    <div class="alert alert-danger">{{ $message }}</div>
    @enderror
    
    <div class="form-group row">
     <label for="maximo" class="col-sm-2 col-form-label">Sueldo máximo del puesto</label>
    <div class="col-sm-10">
      <input value="{{ old('maximo',$puesto->maximo) }}" type="number" name="maximo" placeholder="Introduce el máximo sueldo" id="maximo" min="0.01" max="9999999.99" step="0.01" required class="form-control-plaintext">
    </div>
    @error('maximo')
    <div class="alert alert-danger">{{ $message }}</div>
    @enderror
    
    <input id="enviar" type="submit" value="Editar puesto" class="btn btn-success"/>
</form>

<a href="{{ url('puesto') }}" class="btn btn-secondary"  id="volver" >Volver</a>

@endsection