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
        <p>Confirmar borrar {{ $trabajador->nombre }} {{ $trabajador->apellido }}?</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
        <form id="modalDeleteResourceForm" action="{{ url('trabajador/' . $trabajador->id) }}" method="post">
            @method('delete')
            @csrf
            <input type="submit" class="btn btn-primary" value="Borar trabajado"/>
        </form>
      </div>
    </div>
  </div>
</div>

<h1>Vista de la tabla: {{ $trabajador->nombre }}</h1>
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
            <td>{{ $trabajador->id }}</td>
        </tr>
        <tr>
            <td>Nombre</td>
            <td>{{ $trabajador->nombre }}</td>
        </tr>
        <tr>
            <td>Apellido</td>
            <td>{{ $trabajador->apellido }}</td>
        </tr>
        <tr>
            <td>Email</td>
            <td>{{ $trabajador->email }}</td>
        </tr>
        <tr>
            <td>Telefono</td>
            <td>{{ $trabajador->telefono }}</td>
        </tr>
        <tr>
            <td>Fecha de contratacion</td>
            <td>{{ $trabajador->fechacontrato }}</td>
        </tr>
        <tr>
            <!--Nos llega un array con un elemento y ese array tendra como parametro el nombre el cual tendremos que coger-->
            <td>Puesto de trabajo</td>
            <td>{{ $puesto }}</td>
        </tr>
        <tr>
            <td>Departamento</td>
            <td>{{ $depart }}</td>
        </tr>
    </tbody>
</table>


<a href="{{ url('trabajador/' . $trabajador->id . '/edit') }}" class="btn btn-dark">Editar</a>

<a href="javascript: void(0);" data-bs-toggle="modal" data-bs-target="#modalDelete" class="btn btn-danger">Borar</a>

<a href="{{ url('trabajador') }}" class="btn btn-secondary" >Volver</a>

@endsection