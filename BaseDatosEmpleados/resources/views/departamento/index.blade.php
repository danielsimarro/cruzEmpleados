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
         <p>¿Seguro que quieres borrar <span id="deleteDepartamento">XXX</span>?</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
        <form id="modalDeleteResourceForm" action="" method="post">
            @method('delete')
            @csrf
            <input type="submit" class="btn btn-primary" value="Borrar departamento"/>
        </form>
      </div>
    </div>
  </div>
</div>

<h1>Tabla departamento</h1>
@if(Session::has('texto'))
    <div class="alert alert-{{ session()->get('tipo') }}" role="alert">
        {{ session()->get('texto') }}
    </div>
@endif

<a href="{{ url('departamento/create') }}" class="btn btn-primary">Crear un nuevo departamento</a>

<table class="table table-striped table-dark mt-4">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Nombre</th>
            <th scope="col">Localización del departamento</th>
            <th scope="col">Id del empleado jefe</th>
            <th scope="col">Acciones</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($departamentos as $departamento)
            <tr>
                <td>
                    {{ $departamento->id }}
                </td>
                <td>
                    {{ $departamento->nombre }}
                </td>
                <td>
                    {{ $departamento->localizacion }}
                </td>
                    @if(($departamento->idempleadojefe) != null)
         
                   <td>{{$departamento->idempleadojefe . " " . $departamento->jefe->nombre . " " . $departamento->jefe->apellido}}</td>
         
                    @else
                    
                <td>Sin jefe</td>
         
                    @endif
                <td>
                    <a href="{{ url('departamento/' . $departamento->id) }}" class="btn btn-light">Visualizar</a>
                
                    <a href="{{ url('departamento/' . $departamento->id . '/edit') }}" class="btn btn-dark">Editar</a>
                
                    <a href="javascript: void(0);" 
                       data-name="{{ $departamento->nombre }}"
                       data-url="{{ url('departamento/' . $departamento->id) }}"
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
<script src="{{ url('assets/js/deleteDepartamento.js') }}"></script>
@endsection