@extends('base')

@section('content')
<h1>Crear puesto de trabajo</h1>
@if(Session::has('texto'))
    <div class="alert alert-{{ session()->get('tipo') }}" role="alert">
        {{ session()->get('texto') }}
    </div>
@endif

<form action="{{ url('trabajador') }}" method="post">
    @csrf
    <br>
    <div class="form-group row">
     <label for="nombre" class="col-sm-2 col-form-label">Nombre del trabajador</label>
    <div class="col-sm-2">
      <input value="{{ old('nombre') }}" type="text" name="nombre" placeholder="Introduce el nombre" id="nombre" minlength="2" maxlength="40" required class="form-control-plaintext">
    </div>
    @error('nombre')
    <div class="alert alert-danger">{{ $message }}</div>
    @enderror
    
    <div class="form-group row">
      <label for="apellido" class="col-sm-2 col-form-label">Apellido del trabajador</label>
    <div class="col-sm-4">
      <input value="{{ old('apellido') }}" type="text" name="apellido" id="apellido" placeholder="Introduce el apellido" minlength="2" maxlength="80" required class="form-control-plaintext">
    </div>
    @error('apellido')
    <div class="alert alert-danger">{{ $message }}</div>
    @enderror
    
    <div class="form-group row">
       <label for="telefono" class="col-sm-2 col-form-label">Telefono del trabajador</label>
    <div class="col-sm-2">
      <input value="{{ old('telefono') }}" type="number" name="telefono" placeholder="Introduce el telefono" id="telefono" pattern="[0-9]{9}" required class="form-control-plaintext">
    </div>
    @error('telefono')
    <div class="alert alert-danger">{{ $message }}</div>
    @enderror
    
    
     <div class="form-group row">
        <label for="email" class="col-sm-2 col-form-label">Email del trabajador</label>
    <div class="col-sm-4">
       <input value="{{ old('email') }}" type="text" name="email" placeholder="Introduce el email" id="email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" required class="form-control-plaintext">
    </div>
    @error('email')
    <div class="alert alert-danger">{{ $message }}</div>
    @enderror
    
    <div class="form-group row">
         <label for="fechacontrato" class="col-sm-2 col-form-label">Fecha de contrato</label>
    <div class="col-sm-2">
       <input value="{{ old('fechacontrato') }}" type="date" name="fechacontrato"  id="fechacontrato" required class="form-control-plaintext">
    </div>
    @error('fechacontrato')
    <div class="alert alert-danger">{{ $message }}</div>
    @enderror

    <div class="form-group">
    <label for="puesto">Selecciona el puesto de Trabajo</label>
    <select name="idpuesto" id="puesto" class="form-control" required>
        <option selected disabled value="">&nbsp</option>
         @foreach ($puestos as $puesto)
            <option value="{{ $puesto->id}}">{{ $puesto->nombre }}</option>
        @endforeach
    </select>
    </div>
    @error('idpuesto')
    <div class="alert alert-danger">{{ $message }}</div>
    @enderror
    
    <div class="form-group">
        <label for="departamento">Selecciona el departamento de Trabajo</label>
    <select name="iddepartamento" id="departamento" class="form-control" required>
        <option selected disabled value="">&nbsp</option>
         @foreach ($departamentos as $departamento)
            <option value="{{ $departamento->id}}">{{ $departamento->nombre }}</option>
        @endforeach
    </select>
    </div>
    @error('iddepartamento')
    <div class="alert alert-danger">{{ $message }}</div>
    @enderror
    
    <br>
    <input id="enviar" type="submit" value="Crear trabajador" class="btn btn-success" />
</form>
<br>
<br>
<a href="{{ url('trabajador') }}" class="btn btn-secondary" id="volver">Volver</a>

@endsection