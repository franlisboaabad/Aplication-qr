@extends('layouts.page')
@section('contenedor')

<section>
    <div class="container" data-aos="fade-up">
        <h3>Todos los Autos</h3>

        <div class="row">
            @foreach ($autos as $auto)
                <div class="col-md-4 mb-3">
                    <div class="card">
                        <div class="card-body">
                            <img src="{{ $auto->getImagen }}" class="img-fluid">

                            <p>
                                Marca: {{ $auto->marca }} <br>
                                Modelo: {{ $auto->modelo }} <br>
                                Año de fabricación: {{ $auto->anio }}
                            </p>
                            <p>
                               <b> Precio: s/.</b> {{ $auto->precio }}
                            </p>

                            <a href="{{ route('auto',$auto) }}" class="btn btn-info">Más información</a>
                        </div> 
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
@endsection