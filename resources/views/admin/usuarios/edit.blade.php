@extends('adminlte::page')

@section('title', 'Editar usuario')

@section('content_header')
    <h1>Editar Usuario</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-md-7">
            <div class="card">

                @include('partials.validaciones')

                <div class="card-body">
                    <form action="{{ route('users.update', $user) }}" method="POST">


                        <div class="form-group">
                            <label for="">Nombre</label>
                            <input type="text" class="form-control" name="name" value="{{ old('name', $user->name) }}">
                        </div>

                        <div class="form-group">
                            <label for="">Email</label>
                            <input type="text" class="form-control" name="email"
                                value="{{ old('email', $user->email) }}">
                        </div>

                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label for="password">{{ __('Password') }}</label>
                                    <input id="password" type="password"
                                        class="form-control @error('password') is-invalid @enderror" name="password"
                                        autocomplete="new-password" value="{{ old('password') }}">
                                </div>
                            </div>

                            <div class="col">
                                <div class="form-group">
                                    <label for="password-confirm">{{ __('Confirm Password') }}</label>
                                    <input id="password-confirm" type="password" class="form-control"
                                        name="password_confirmation" autocomplete="new-password"
                                        value="{{ old('password_confirmation') }}">
                                </div>

                            </div>
                        </div>

                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <button class="btn btn-success btn-xs">Editar usuario</button>
                            <a href="{{ route('users.index') }}" class="btn btn-danger btn-xs">Lista de usuarios</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@stop
