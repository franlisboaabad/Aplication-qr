@extends('adminlte::page')

@section('title', 'Registro de usuarios')

@section('content_header')
    <h1>Nuevo Usuario</h1>
@endsection

@section('content')

    <div class="row">
        <div class="col-md-7">
            <div class="card">

                <div class="card-body">


                    @include('partials.validaciones')


                    <form method="POST" action="{{ route('users.store') }}">
                        @csrf

                        <div class="form-group">
                            <label for="">Nombre</label>
                            <input type="text" name="name" value="{{ old('name') }}" class="form-control"
                                value="{{ old('name') }}" required>
                        </div>

                        <div class="form-group">
                            <label for="">Email</label>
                            <input type="text" name="email" value="{{ old('email') }}" class="form-control"
                                value="{{ old('email') }}" required>
                        </div>

                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label for="password">{{ __('Password') }}</label>
                                    <input id="password" type="password"
                                        class="form-control @error('password') is-invalid @enderror" name="password"
                                        required autocomplete="new-password" value="{{ old('password') }}">
                                </div>
                            </div>

                            <div class="col">
                                <div class="form-group">
                                    <label for="password-confirm">{{ __('Confirm Password') }}</label>
                                    <input id="password-confirm" type="password" class="form-control"
                                        name="password_confirmation" required autocomplete="new-password"
                                        value="{{ old('password_confirmation') }}">
                                </div>

                            </div>
                        </div>


                        <hr>




                        <div class="form-group">
                            <button class="btn btn-success btn-xs" type="submit">Registrar usuario</button>
                            <a href="{{ route('users.index') }}" class=" btn btn-danger btn-xs">Lista de usuarios</a>
                        </div>

                    </form>


                </div>
            </div>
        </div>
    </div>

@endsection

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script>
        console.log('hi!')
    </script>
@stop
