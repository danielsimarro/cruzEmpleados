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
         <p>¿Seguro que quieres borrar <span id="deleteTrabajador">XXX</span>?</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
        <form id="modalDeleteResourceForm" action="" method="post">
            @method('delete')
            @csrf
            <input type="submit" class="btn btn-primary" value="Borrar trabajador"/>
        </form>
      </div>
    </div>
  </div>
</div>

<h1>Tabla trabajadores</h1>
@if(Session::has('texto'))
    <div class="alert alert-{{ session()->get('tipo') }}" role="alert">
        {{ session()->get('texto') }}
    </div>
@endif

<a href="{{ url('trabajador/create') }}" class="btn btn-primary">Crear un nuevo trabajador</a>
<a href="{{ url('imagen') }}" class="btn btn-success">Subir una imagen</a>

<table class="table table-striped table-dark mt-4">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Nombre</th>
            <th scope="col">Apellido</th>
            <th scope="col">Email</th>
            <th scope="col">Teléfono</th>
            <th scope="col">Fecha de Contrato</th>
            <th scope="col">Acciones</th>
            
        </tr>
    </thead>
    <tbody>
        @foreach ($trabajadores as $trabajador)
            <tr>
                <td>
                    {{ $trabajador->id }}
                </td>
                <td>
                    {{ $trabajador->nombre }}
                </td>
                <td>
                    {{ $trabajador->apellido }}
                </td>
                <td>
                    {{ $trabajador->email }}
                </td>
                <td>
                    {{ $trabajador->telefono }}
                </td>
                <td>
                    {{ $trabajador->fechacontrato }}
                </td>
                
                <td>
                    <a href="{{ url('trabajador/' . $trabajador->id) }}" class="btn btn-light">Visualizar</a>
                
                
                    <a href="{{ url('trabajador/' . $trabajador->id . '/edit') }}" class="btn btn-dark">Editar</a>
                
                
                    <a href="javascript: void(0);" 
                       data-name="{{ $trabajador->nombre }}"
                       data-url="{{ url('trabajador/' . $trabajador->id) }}"
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
<script src="{{ url('assets/js/deleteTrabajador.js') }}"></script>
@endsection