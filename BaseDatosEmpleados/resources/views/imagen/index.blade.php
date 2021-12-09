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
         <p>¿Seguro que quieres borrar <span id="deletePuesto">XXX</span>?</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cencelar</button>
        <form id="modalDeleteResourceForm" action="" method="post">
            @method('delete')
            @csrf
            <input type="submit" class="btn btn-primary" value="Borrar imagen"/>
        </form>
      </div>
    </div>
  </div>
</div>

<h1>Tabla Imagenes</h1>
@if(Session::has('texto'))
    <div class="alert alert-{{ session()->get('tipo') }}" role="alert">
        {{ session()->get('texto') }}
    </div>
@endif

<a href="{{ url('imagen/create') }}" class="btn btn-primary">Crear un nuevo registro en la tabla imagenes</a>

<table class="table table-striped table-dark mt-4">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Empleado al que pertenece la imagen</th>
            <th scope="col">Nombre del archivo</th>
            <th scope="col">Tipo de archivo</th>
            <th scope="col">Tiene alguna foto subida</th>
            <th scope="col">Acciones</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($imagenes as $imagen)
            <tr>
                <td>
                    {{ $imagen->id }}
                </td>
                <td>
                    {{ $imagen->idtrabajador }}
                </td>
                <td>
                    {{ $imagen->nombre }}
                </td>
                <td>
                    {{ $imagen->mimetype }}
                </td>
                <td>
                    {{ $imagen->archivo }}
                </td>
                <td>
                    <a href="{{ url('imagen/' . $imagen->id) }}" class="btn btn-light">Visualizar</a>
                
                    <a href="{{ url('imagen/' . $imagen->id . '/edit') }}" class="btn btn-dark">Editar</a>
                
                    <a href="javascript: void(0);" 
                       data-name="{{ $imagen->nombre }}"
                       data-url="{{ url('imagen/' . $imagen->id) }}"
                       data-bs-toggle="modal"
                       data-bs-target="#modalDelete"
                        class="btn btn-danger">Borrar</a>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

<a href="{{ url('/') }}" class="btn btn-secondary">Volver a la ventana principal</a>

@endsection


@section('js')
<script src="{{ url('assets/js/deletePuesto.js') }}"></script>
@endsection