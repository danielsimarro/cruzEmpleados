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
        <p>Confirmar borrar {{ $imagen->nombre }}?</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
        <form id="modalDeleteResourceForm" action="{{ url('imagen/' . $imagen->id) }}" method="post">
            @method('delete')
            @csrf
            <input type="submit" class="btn btn-primary" value="Borrar imagen"/>
        </form>
      </div>
    </div>
  </div>
</div>

<h1>Vista de la tabla: {{ $imagen->nombre }}</h1>
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
            <td>{{ $imagen->id }}</td>
        </tr>
        <tr>
            <td>Trabajador que tiene la imagen</td>
            <td>{{ $imagen->idtrabajador . " " . $nombre}} </td>
        </tr>
        <tr>
            <td>Nombre del archivo</td>
            <td>{{ $imagen->nombre }}</td>
        </tr>
        <tr>
            <td>Tipo de archivo</td>
            <td>{{ $imagen->mimetype }}</td>
        </tr>
    </tbody>
</table>


<a href="{{ url('imagen/' . $imagen->id . '/edit') }}" class="btn btn-dark">Editar</a>

<a href="javascript: void(0);" data-bs-toggle="modal" data-bs-target="#modalDelete" class="btn btn-danger">Borar</a>

<a href="{{ url('imagen') }}" class="btn btn-secondary" >Volver</a>


	
<?php $exists = file_exists( 'upload/' . $idimagen . "-" . $idtrabajador );?>

@if($exists == 1)
<!--Mostrar imagen en el html-->
<img src="{{ url('upload/' . $idimagen . "-" . $idtrabajador) }}">

@endif

@endsection