@extends('base')

@section('content')
<h1>Edit de la tabla: {{ $departamento->nombre }}</h1>
@if(Session::has('texto'))
    <div class="alert alert-{{ session()->get('tipo') }}" role="alert">
        {{ session()->get('texto') }}
    </div>
@endif
<form action="{{ url('departamento/' . $departamento->id) }}" method="post">
    @csrf
    @method('put')
    <div class="form-group row">
     <label for="nombre" class="col-sm-2 col-form-label">Nombre del departamento</label>
    <div class="col-sm-2">
      <input value="{{ old('nombre',$departamento->nombre) }}" type="text" name="nombre" placeholder="Introduce el nombre" id="nombre" minlength="2" maxlength="100" required class="form-control-plaintext">
    </div>
    @error('nombre')
    <div class="alert alert-danger">{{ $message }}</div>
    @enderror
    
    <div class="form-group row">
     <label for="localizacion" class="col-sm-2 col-form-label">Donde se encuentra</label>
    <div class="col-sm-2">
      <input value="{{ old('localizacion',$departamento->localizacion) }}" type="text" name="localizacion" placeholder="Introduce la localización" id="localizacion" minlength="2" maxlength="150" required class="form-control-plaintext">
    </div>
    @error('localizacion')
    <div class="alert alert-danger">{{ $message }}</div>
    @enderror
    
 <div class="form-group">
      <label for="trabajador">Selecciona el jefe del departamento</label>
    <select name="idempleadojefe" id="trabajador" class="form-control"  >
        <option selected value="">&nbsp</option>
         @foreach ($trabajadores as $trabajador)
            <option value="{{ $trabajador->id}}">{{ $trabajador->nombre . ' ' . $trabajador->apellido  }}</option>
        @endforeach
    </select>
    </div>
    @error('idempleadojefe')
    <div class="alert alert-danger">{{ $message }}</div>
    @enderror
    
    <br>
    
    
    <input  id="enviar" type="submit" value="Editar departamento" class="btn btn-success"/>
</form>

<a href="{{ url('departamento') }}" class="btn btn-secondary"  id="volver" >Volver</a>

@endsection

