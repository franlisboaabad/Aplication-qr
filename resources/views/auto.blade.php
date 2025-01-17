@extends('layouts.page')
@section('contenedor')
<section>
    <div class="container">
        <h1>Caracteristicas del auto</h1>
        <hr>
        <div class="row">
            <div class="col-md-5">
                <img src="{{ $auto->getImagen }}" alt="{{ $auto->slug }}" class="img-fluid">
            </div>
            <div class="col-md"></div>
            <div class="col-md-6">
                <p>Marca: {{ $auto->marca }} </p>
                <p>Modelo: {{ $auto->modelo }} </p>
                <p>Color: {{ $auto->color }} </p>
                <p>Año de fabricación: {{ $auto->anio }} </p>
                <p>Descripción: {{ $auto->descripcion }} </p>
                <hr>
                <p>Publicado: {{ $auto->created_at }} </p>
                <a href="" class="btn btn-success btn-xs"> <i class="fa fa-dollar"></i> Solicitar proforma.</a>
                <a href="" class="btn btn-success btn-xs"> <i class="fa fa-dollar"></i> Comprar Ahora</a>
            </div>
        </div>
    </div>
</section>
@endsection