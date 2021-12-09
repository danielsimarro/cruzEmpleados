@extends('base')

@section('content')

<div class="modal" id="modalDelete" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Confirmar borrado</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <p>¿Seguro que quieres borrar {{ $departamento->nombre }}?</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
        <form id="modalDeleteResourceForm" action="{{ url('departamento/' . $departamento->id) }}" method="post">
            @method('delete')
            @csrf
            <input type="submit" class="btn btn-primary" value="Borrar departamento"/>
        </form>
      </div>
    </div>
  </div>
</div>

<h1>Vista de la tabla: {{ $departamento->nombre }}</h1>
@if(Session::has('texto'))
    <div class="alert alert-{{ session()->get('tipo') }}" role="alert">
        {{ session()->get('texto') }}
    </div>
@endif

<table class="table table-striped">
    <thead>
        <tr>
            <td>
                Atributos
            </td>
            <td>
                Valores
            </td>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>Id</td>
            <td>{{ $departamento->id }}</td>
        </tr>
        <tr>
            <td>Nombre</td>
            <td>{{ $departamento->nombre }}</td>
        </tr>
        <tr>
            <td>Localizacion</td>
            <td>{{ $departamento->localizacion }}</td>
        </tr>
        <tr>
            <td>Jefe del departamento</td>
            @if(($departamento->idempleadojefe) != null)
         
           <td>{{$departamento->idempleadojefe . ' ' . $nombre . ' '  . $apellido }}</td>
         
         @else
           <td>Este departamento no tiene jefe</td>
         
         @endif
        </tr>
    </tbody>
</table>


<a href="{{ url('departamento/' . $departamento->id . '/edit') }}" class="btn btn-dark">Editar</a>

<a href="javascript: void(0);" data-bs-toggle="modal" data-bs-target="#modalDelete" class="btn btn-danger">Borar</a>

<a href="{{ url('departamento') }}" class="btn btn-secondary" >Volver</a>

@endsection