@extends('adminlte::page')

@section('title', 'Editar Auto')

@section('content_header')
    <h1>Nuevo Auto</h1>
@stop

@section('content')
    <p>Debes llenar todos los datos, para editar el auto.</p>

    <div class="card">


        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif


        <div class="card-body">
            <div class="row">
                <div class="col-md-6">

                     <form action="{{ route('autos.update', $auto ) }}" method="POST" enctype="multipart/form-data" >

                        <div class="form-group">
                            <label for="">Marca</label>
                            <input type="text" name="marca" required class="form-control" value="{{ old('marca', $auto->marca ) }}">
                        </div>
                        <div class="form-group">
                            <label for="">Modelo</label>
                            <input type="text" name="modelo" required class="form-control" value="{{ old('modelo', $auto->modelo) }}">
                        </div>
                        <div class="form-group">
                            <label for="">Anio</label>
                            <input type="date" name="anio" required class="form-control" value="{{ old('anio', $auto->anio) }}">
                        </div>

                        <div class="form-group">
                            <label for="">Color</label>
                            <input type="text" name="color" required class="form-control" value="{{ old('color', $auto->color) }}">
                        </div>

                        <div class="form-group">
                            <label for="">Precio</label>
                            <input type="text" name="precio" required class="form-control" value="{{ old('precio', $auto->precio) }}">
                        </div>

                        <div class="form-group">
                            <label for="">Descripcion</label>
                           <textarea name="descripcion" rows="10" class="form-control">
                            {{ old('descripcion', $auto->descripcion) }}
                           </textarea>
                        </div>

                        <div class="form-group">
                            <label for="">Imagen</label>
                            <input type="file" name="imagen_principal">
                        </div>



                        <div class="form-group">
                            @method('PUT')
                            @csrf
                            <button type="submit"  class="btn btn-success">EDITAR</button>
                            <a href="{{ route('autos.index') }}" class="btn btn-warning">CANCELAR</a>
                        </div>
                    </form>
                  
                </div>
                <div class="col-md-4">
                    <img src="{{ $auto->getImagen }}" alt="" class="img-fluid">
                </div>
            </div>
        </div>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script>
        console.log('Hi!');
    </script>
@stop
