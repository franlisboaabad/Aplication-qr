@extends('adminlte::page')

@section('title', 'Cartas digitales')

@section('content_header')
    <h1>Lista de cartas digitales</h1>
@stop

@section('content')
    {{-- <p>Welcome to this beautiful admin panel.</p> --}}
    <div class="card">
        <div class="card-body">
            <a href="{{ route('cartas.create') }}" class="btn btn-success"> <i class="fa fa-file-pdf"></i> Nueva carta</a>


            @include('partials.validaciones')

            
            <table class="table mb-3">
                <thead>
                    <th>Id</th>
                    <th>Empresa</th>
                    <th>Carta Url</th>
                    <th>Estado</th>
                    <th>Configuraciones</th>
                </thead>
                <tbody>

                    @foreach ($cartas as $carta)
                        <tr>
                            <td>{{ $carta->id }}</td>
                            <td>{{ $carta->nombre_empresa }}</td>
                            <td>
                                <a href="{{ $carta->getCarta }}" target="_Blank">Ver carta digital</a>
                            </td>
                            <td>
                                <span class="badge {{ $carta->estado ? 'badge-activo' : 'badge-inactivo' }}">
                                    {{ $carta->estado ? 'Activo' : 'Inactivo' }}
                                </span>
                            </td>
                            <td>
                                <form action="{{ route('cartas.destroy', $carta) }}" method="POST">



                                    <a href="{{ route('cartas.generar-codigo-qr', $carta) }}" title="Descargar qr"
                                        class="btn btn-warning btn-xs" target="_Blank"> <i class="fa fa-file"></i></a>

                                        
                                    <a href="{{ route('cartas.edit', $carta) }}" class="btn btn-success btn-xs"
                                        title="Editar"> <i class="fa fa-edit"></i> </a>



                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger btn-xs"
                                        onclick="return confirm('¿Esta seguro de eliminar el registro?')" title="Eliminar">
                                        <i class="fa fa-trash"></i> </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach



                </tbody>



            </table>

            {{ $cartas->links() }}
        </div>
    </div>
@stop

@section('css')
    <style>
        /* Estilos para el badge cuando está activo */
        .badge-activo {
            background-color: #4CAF50;
            /* Cambia el color de fondo a tu preferencia */
            color: white;
            /* Cambia el color del texto a tu preferencia */
        }

        /* Estilos para el badge cuando está inactivo */
        .badge-inactivo {
            background-color: #f44336;
            /* Cambia el color de fondo a tu preferencia */
            color: white;
            /* Cambia el color del texto a tu preferencia */
        }
    </style>
@stop

@section('js')
    <script>
        console.log('Hi!');
    </script>
@stop
