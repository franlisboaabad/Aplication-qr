<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Carta digital qr - {{ $nombre_empresa }} </title>
    <style>
        body,
        html {
            height: 100%;
            margin: 0;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        div {
            position: relative;
        }

        img {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -100%);
        }
    </style>

<body>
    <div>
        <img src="{{ $qrCode }}" alt="{{ $nombre_empresa }}">
    </div>
</body>

</html>
