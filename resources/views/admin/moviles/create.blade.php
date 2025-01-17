@extends('adminlte::page')

@section('title', 'Registro de Auto')

@section('content_header')
    <h1>Nuevo Auto</h1>
@stop

@section('content')
    <p>Debes llenar todos los datos, para registrar el auto.</p>

    <div class="card">


        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif


        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif



        <div class="card-body">
            <div class="row">
                <div class="col-md-7">
                    <form action="{{ route('autos.store') }}" enctype="multipart/form-data" method="POST">

                        <div class="form-group">
                            <label for="">Marca</label>
                            <input type="text" name="marca" required class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="">Modelo</label>
                            <input type="text" name="modelo" required class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="">Anio</label>
                            <input type="date" name="anio" required class="form-control">
                        </div>

                        <div class="form-group">
                            <label for="">Color</label>
                            <input type="text" name="color" required class="form-control">
                        </div>

                        <div class="form-group">
                            <label for="">Precio</label>
                            <input type="text" name="precio" required class="form-control">
                        </div>

                        <div class="form-group">
                            <label for="">Descripcion</label>
                            <textarea name="descripcion" rows="10" class="form-control"></textarea>
                        </div>

                        <div class="form-group">
                            <label for="">Imagen</label>
                            <input type="file" name="imagen_principal">
                        </div>


                        <div class="form-group">
                            @method('POST')
                            @csrf
                            <button class="btn btn-success">REGISTRAR</button>
                        </div>
                    </form>
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
