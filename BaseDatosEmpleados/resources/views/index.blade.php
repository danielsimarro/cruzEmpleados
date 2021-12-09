@php
    use App\Http\Controllers\IndexController;
@endphp

@extends('base')

@section('content')
    <div class="p-5 mb-4 bg-light rounded-3">
      <div class="container-fluid py-5">
        <h1 class="display-5 fw-bold">Cruz Empleados</h1>
        <br>
        <p class="col-md-8 fs-4">
          <a href="{{ url('puesto') }}" class="btn btn-secondary">Crear Puestos</a>
        </p>
        
        <p class="col-md-8 fs-4">
          <a href="{{ url('departamento') }}" class="btn btn-secondary">Crear Departamentos</a>
        </p>
        
        <p class="col-md-8 fs-4">
          <a href="{{ url('trabajador') }}" class="btn btn-secondary">Crear Trabajadores</a>
        </p>
      </div>
    </div>
    
@endsection

