@extends('adminlte::page')

@section('title', 'Nueva carta digital')

@section('content_header')
    <h1>Nueva carta</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-md-6">
            <div class="card">


               @include('partials.validaciones')


                <div class="card-body">
                    <form action="{{ route('menus.store') }}" method="POST" enctype="multipart/form-data">

                        <div class="form-group">
                            <label for="">Nombre de compañia</label>
                            <input type="text" name="nombre_empresa" value="{{ old('nombre_empresa') }}"
                                class="form-control" required>
                        </div>


                        <div class="form-group">
                            <label for="">Documento carta PDF</label>
                            <input type="file" name="carta_path" class="form-control">
                        </div>


                        <div class="form-group">
                            @csrf
                            @method('POST')
                            <button type="submit" class="btn btn-primary btn-xs">REGISTRAR CARTA</button>
                            <a href="{{route('menus.index')}}" class="btn btn-danger btn-xs">Lista de cartas</a>
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
