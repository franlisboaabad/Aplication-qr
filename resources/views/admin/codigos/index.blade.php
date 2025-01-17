@extends('adminlte::page')

@section('title', 'Codigos QR')

@section('content_header')
    <h1>Lista codigos QR</h1>
@stop

@section('content')
    {{-- <p>Welcome to this beautiful admin panel.</p> --}}
    <div class="card">
        <div class="card-body">
            <table class="table">
                <thead>
                    <th>ID</th>
                    <th>Url de documento</th>
                    <th>Codigo QR</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                </thead>
                <tbody>
                    @foreach ($codigos as $codigo)
                        <tr>
                            <td>{{ $codigo->id }}</td>
                            <td><a href="{{ $codigo->url }}" target="_Blank"> {{ $codigo->url }} </a> </td>
                            {{-- <td> <a href="{{ $codigo->codigo_qr }}" target="_Blank"> {{ $codigo->codigo_qr }} </a> </td> --}}

                            <td>
                                <!-- Enlace para descargar el código QR -->
                                <a href="{{ $codigo->codigo_qr }}" download="{{ basename($codigo->codigo_qr) }}"
                                    class="btn btn-primary btn-xs">
                                    Descargar
                                </a>
                            </td>

                            <td>
                                @if ($codigo->active)
                                    <span class="badge badge-success">Activo</span>
                                @else
                                    <span class="badge badge-danger">Eliminado</span>
                                @endif
                            </td>
                            <td>
                                <form action="{{ route('codigos.destroy', $codigo) }}" method="POST">
                                    @csrf
                                    @method('DELETE')

                                    @if ($codigo->active)
                                    <button class="btn btn-danger btn-xs" onclick="return confirm('¿Estás seguro de que deseas eliminar este registro?')">Eliminar</button>
                                    @else
                                        <button class="btn btn-info btn-xs" onclick="return confirm('¿Estás seguro de que deseas restaurar este registro?')">Restaurar</button>
                                    @endif
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            {{ $codigos->links() }}

        </div>
    </div>
@stop

@section('css')

@stop

@section('js')

@stop
