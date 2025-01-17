@extends('adminlte::page')

@section('title', 'Lista de Autos')

@section('content_header')
    <h1>Autos</h1>
@stop

@section('content')
    <p>Welcome to this beautiful admin panel.</p>




    <div class="card">
        <div class="card-body">
            <a href="{{ route('autos.create') }}" class="btn btn-danger">Nuevo Auto</a>

            <table class="table">
                <thead>
                    <th>#</th>
                    <th>Marca</th>
                    <th>Modelo</th>
                    <th>Año</th>
                    <th>Color</th>
                    <th>Precio</th>
                    <th>Imagen</th>
                    <th>Opciones</th>
                </thead>
                <tbody>
                    @foreach ($autos as $auto)
                        <tr>
                            <td>{{ $auto->id }}</td>
                            <td>{{ $auto->marca }}</td>
                            <td>{{ $auto->modelo}}</td>
                            <td>{{ $auto->anio}}</td>
                            <td>{{ $auto->color }}</td>
                            <td>{{ $auto->precio }}</td>
                            <td>
                                <a href="{{ $auto->getImagen }}" target="_Blank"> Visualizar Auto </a>
                            </td>
                            <td>
                                <form action="{{ route('autos.destroy', $auto ) }}" method="POST">
                                    <a href="{{ route('autos.edit', $auto ) }}" class="btn btn-warning">Editar</a>
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger" onclick="return confirm('¿Esta seguro de eliminar el registro?')">Eliminar</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

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
