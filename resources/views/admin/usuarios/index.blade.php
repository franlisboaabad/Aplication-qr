@extends('adminlte::page')

@section('title', 'Lista de usuarios')
{{-- @section('plugins.Datatables', true) --}}
@section('content_header')
    <h1>Lista de Usuarios</h1>
@stop

@section('content')
    {{-- <p>Lista de usuarios</p> --}}
    <div class="card">
        <div class="card-body">
            <a href="{{ route('users.create') }}" class="btn  btn-success"><i class="fa fa-user"></i> Nuevo Usuario</a>
            <hr>

            @include('partials.validaciones')
          

            <table class="table" >
                <thead>
                    <th>#</th>
                    <th>Nombre</th>
                    <th>Email</th>
                    <th>Opciones</th>
                </thead>
                <tbody>
                    @foreach ($usuarios as $usuario)
                        <tr>
                            <td>{{ $usuario->id }}</td>
                            <td>{{ $usuario->name }}</td>
                            <td>{{ $usuario->email }}</td>
                            <td>
                                <form action="{{ route('users.destroy', $usuario) }}" method="POST">

                                    <a href="{{ route('users.edit', $usuario) }}" class="btn btn-info btn-xs">Editar</a>

                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-xs"
                                        onclick="return confirm('¿Esta seguro de eliminar el registro?')">Eliminar</button>
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
    {{-- @include('partials.css') --}}
@stop


@section('js')
    {{-- @include('partials.js') --}}
    {{-- 
    <script>
        $(document).ready(function() {
            $('#table-usuarios').DataTable({
                dom: 'Bfrtip',
                buttons: [
                    'excel',
                    'pdf'
                ]
            });
        });
    </script> --}}

@stop
