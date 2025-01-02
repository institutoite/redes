<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reporte de Servicio</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            position: relative;
        }
        .container {
            padding: 20px;
            margin: 20px auto;
            position: relative;
            z-index: 2; /* Asegura que el contenido esté delante */
        }
        header {
            position: fixed;
            top: 0;
            width: 100%;
            background: white;
            padding: 10px 0;
            text-align: center;
            z-index: 1; /* Encabezado encima de todo */
        }
        header img {
            max-width: 120px;
            float: right; /* Alinea la imagen a la derecha */
            margin-right: 20px; /* Agrega espacio entre la imagen y el borde derecho */
        }

        header h1 {
            margin: 10px 0 5px;
            font-size: 24px;
        }
        .background-logo {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: 1; /* Imagen detrás de todo */
            opacity: 0.1; /* Transparencia para no obstruir la lectura */
            background: url('file://{{ public_path("images/logo.png") }}') no-repeat center;
            background-size: contain; /* Ajusta la imagen al tamaño del contenedor */
        }
        .modalidad {
            page-break-after: always;
        }
        .modalidad h2 {
            color: rgb(55,95,122);
            margin-bottom: 10px;
        }
        .card {
            /*border: 1px solid #ddd;*/
            margin-bottom: 20px;
            padding: 15px;
            border-radius: 5px;
        }
        .card h5 {
            margin-bottom: 10px;
            color: #110d0d;
        }
        .card p, .card ul {
            margin: 5px 0;
            color: #aaa;
        }
        .card-footer {
            text-align: center;
            font-size: 12px;
            margin-top: 20px;
            color: #aaa;
        }
    </style>
</head>
<body>
    <!-- Imagen de fondo -->
    <div class="background-logo"></div>

    <!-- Encabezado -->
    <header>
        <img src="file://{{ public_path('images/logo.png') }}" alt="Logotipo">
    </header>
   
    <!-- Contenido principal -->
    <div class="container">
        <p>{{ $product->nombre }}</p>
        @foreach ($product->modalidades as $modalidad)
        <div class="modalidad" style="@if (!$loop->last) page-break-after: always; @endif">
            <h2>{{ $modalidad->modalidad }}</h2>
            <div class="card">
                <h5>Inversión:</h5>
                <p>Bs {{ number_format($modalidad->inversion, 2) }}</p>
                <h5>Descripción:</h5>
                <p>{{ $modalidad->descripcion }}</p>
                <h5>Horarios disponibles:</h5>
                <ul>
                    @foreach ($modalidad->horarios as $horario)
                        <li>
                            @if ($horario->estado == 0)
                                <span style="text-decoration: line-through; color: rgb(67, 67, 67);">
                                    {{ $horario->horario }} - <span class="text-danger">(SIN CUPO)</span>
                                </span>
                            @else
                                {{ $horario->horario }}
                            @endif
                        </li>
                    @endforeach
                </ul>
                <h5>Días de asistencia:</h5>
                <ul>
                    @foreach ($modalidad->dias as $dia)
                        <li>{{ $dia->dia }}</li>
                    @endforeach
                </ul>
                <h5>Caracteristicas:</h5>
                <ul>
                    @foreach ($modalidad->ventajas as $ventaja)
                        <li>{{ $ventaja->ventaja }}: {{ $ventaja->detalle }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
        @endforeach
    </div>
</body>
</html>
