<div class="modal" id="modalUpload" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Subir archivo</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <p>Subir imagen</p>
        <p>
            <input type="file" name="photo" form="uploadForm" accept="image/*" class="form-control"/>
        </p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        <form  id="uploadForm" action="{{ url('imagen/' .$imagen->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="submit" class="btn btn-primary" value="Subir"/>
        </form>
      </div>
    </div>
  </div>
</div>
@extends('base')

@section('content')
<h1>Edit de la tabla: {{ $imagen->nombre }}</h1>
@if(Session::has('texto'))
    <div class="alert alert-{{ session()->get('tipo') }}" role="alert">
        {{ session()->get('texto') }}
    </div>
@endif
<form action="{{ url('imagen/' . $imagen->id) }}" method="post">
    @csrf
    @method('put')
    <div class="form-group row">
     <label for="nombre" class="col-sm-2 col-form-label">Nombre del archivo</label>
    <div class="col-sm-10">
      <input value="{{ old('nombre',$imagen->nombre) }}" type="text" name="nombre" placeholder="Introduce el nombre" id="nombre" minlength="2" maxlength="100" required class="form-control-plaintext">
    </div>
    @error('nombre')
    <div class="alert alert-danger">{{ $message }}</div>
    @enderror
    
    <input name="archivo" type="hidden" value="si">
    
    <input  id="enviarimg" type="button" name="btUpdate" value="Subir imagen" class="btn btn-info"  data-bs-toggle="modal" data-bs-target="#modalUpload" required/>
    <input id="enviar" type="submit" value="Editar imagen" class="btn btn-success"/>
</form>



<a href="{{ url('imagen') }}" class="btn btn-secondary"  id="volver" >Volver</a>

@endsection