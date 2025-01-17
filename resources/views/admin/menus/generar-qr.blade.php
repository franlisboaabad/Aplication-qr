@extends('adminlte::page')

@section('title', 'Generar codigo qr')

@section('content_header')
    <h1>Generación de codigo QR</h1>
@stop

@section('content')
    {{-- <p>Welcome to this beautiful admin panel.</p> --}}
    <div class="card">
        <div class="card-body">
            <form method="POST">
                @csrf
                <div class="form-group">
                    <label for="">Ingresar URL</label>
                    <input type="text" id="link" class="form-control" required>
                </div>

                <div class="form-group">
                    <button type="button" class="btn btn-warning" id="btn_generar">GENERAR CODIGO QR</button>
                </div>

                <!-- Botón para registrar el QR en la base de datos -->
                <div class="form-group">
                    <button type="button" class="btn btn-success" id="btn_registrar" disabled>REGISTRAR CÓDIGO QR</button>
                </div>

            </form>


            <div id="codigoQRContainer"></div>
        </div>
    </div>
@stop

@section('css')
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
@stop

@section('js')
    <script>
        $(document).ready(function() {

            $('#btn_generar').click(function(e) {
                e.preventDefault();
                var url = $("#link").val();

                if (url.length > 0) {

                    $.ajax({
                        type: "POST", // Método de envío (puedes usar "GET" o "POST" según tus necesidades)
                        url: "/generar-qr-carta-digital", // URL del controlador que recibirá la solicitud AJAX
                        data: {
                            _token: "{{ csrf_token() }}", // Agregar el token CSRF para protección contra CSRF
                            url: url // Enviar el valor del input al controlador con la clave "url"
                        },
                        success: function(response) {
                            // Manejar la respuesta del controlador
                            $("#codigoQRContainer").html(response);
                            $('#btn_registrar').prop('disabled', false); // Habilitar el botón de registro

                            console.log(response);

                        },
                        error: function(xhr, status, error) {
                            // Manejar errores si los hay
                            console.error(error);
                        }
                    });

                } else {
                    alert('Ingresar texto url para generar el codigo QR')
                }
            });


            // Registrar el QR en la base de datos cuando el usuario haga clic en el botón
            $('#btn_registrar').click(function(e) {
                e.preventDefault();
                var url = $("#link").val();
                var codigo_qr = $('#codigoQRContainer').val();

                console.log(codigo_qr);


                // if (url.length > 0 && qrCodeBase64.length > 0) {
                //     $.ajax({
                //         type: "POST",
                //         url: "/codigos",
                //         data: {
                //             _token: "{{ csrf_token() }}",
                //             url: url,
                //             codigo_qr: qrCodeBase64 // Enviar el código QR generado
                //         },
                //         success: function(response) {
                //             alert('Código QR registrado exitosamente');
                //         },
                //         error: function(xhr, status, error) {
                //             console.error(error);
                //             alert('Hubo un error al registrar el código QR');
                //         }
                //     });
                // } else {
                //     alert('Genera el código QR primero antes de registrar');
                // }
            });

        });
    </script>
@stop
