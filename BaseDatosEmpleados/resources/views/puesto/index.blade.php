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
            <input type="submit" class="btn btn-primary" value="Borrar puesto"/>
        </form>
      </div>
    </div>
  </div>
</div>

<h1>Tabla Puestos</h1>
@if(Session::has('texto'))
    <div class="alert alert-{{ session()->get('tipo') }}" role="alert">
        {{ session()->get('texto') }}
    </div>
@endif

<a href="{{ url('puesto/create') }}" class="btn btn-primary">Crear un nuevo puesto</a>

<table class="table table-striped table-dark mt-4">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Nombre</th>
            <th scope="col">Salario mínimo del puesto</th>
            <th scope="col">Salario maximo del puesto</th>
            <th scope="col">Acciones</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($puestos as $puesto)
            <tr>
                <td>
                    {{ $puesto->id }}
                </td>
                <td>
                    {{ $puesto->nombre }}
                </td>
                <td>
                    {{ $puesto->minimo }}
                </td>
                <td>
                    {{ $puesto->maximo }}
                </td>
                <td>
                    <a href="{{ url('puesto/' . $puesto->id) }}" class="btn btn-light">Visualizar</a>
                
                    <a href="{{ url('puesto/' . $puesto->id . '/edit') }}" class="btn btn-dark">Editar</a>
                
                    <a href="javascript: void(0);" 
                       data-name="{{ $puesto->nombre }}"
                       data-url="{{ url('puesto/' . $puesto->id) }}"
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