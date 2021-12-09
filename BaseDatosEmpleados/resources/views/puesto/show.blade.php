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
        <p>Confirmar borrar {{ $puesto->nombre }}?</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
        <form id="modalDeleteResourceForm" action="{{ url('puesto/' . $puesto->id) }}" method="post">
            @method('delete')
            @csrf
            <input type="submit" class="btn btn-primary" value="Borrar puesto"/>
        </form>
      </div>
    </div>
  </div>
</div>

<h1>Vista de la tabla: {{ $puesto->nombre }}</h1>
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
            <td>{{ $puesto->id }}</td>
        </tr>
        <tr>
            <td>Nombre</td>
            <td>{{ $puesto->nombre }}</td>
        </tr>
        <tr>
            <td>Minimo</td>
            <td>{{ $puesto->minimo }}</td>
        </tr>
        <tr>
            <td>Maximo</td>
            <td>{{ $puesto->maximo }}</td>
        </tr>
    </tbody>
</table>


<a href="{{ url('puesto/' . $puesto->id . '/edit') }}" class="btn btn-dark">Editar</a>

<a href="javascript: void(0);" data-bs-toggle="modal" data-bs-target="#modalDelete" class="btn btn-danger">Borar</a>

<a href="{{ url('puesto') }}" class="btn btn-secondary" >Volver</a>

@endsection