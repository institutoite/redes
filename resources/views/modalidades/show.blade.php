<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modalidades de {{ $product->nombre }}</title>
    {{-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css"> --}}
    <link rel="stylesheet" href="{{  asset('assets/css/bootstrap.min.css')}}">
</head>
<body>
    <div class="container mt-5">
        <h1 class="mb-4">Modalidades para: {{ $product->nombre }}</h1>

        @foreach ($product->modalidades as $modalidad)
        <div class="card mb-4">
            <div class="card-header bg-primary text-white">
                <h3>{{ $modalidad->modalidad }}</h3>
                <p class="mb-0">Inversión: Bs {{ number_format($modalidad->inversion, 2) }}</p>
            </div>
            <div class="card-body">
                <h5>Descripción:</h5>
                <p>{{ $modalidad->descripcion }}</p>

                <h5>Horarios:</h5>
                <ul>
                    @foreach ($modalidad->horarios as $horario)
                    <li>{{ $horario->horario }}</li>
                    @endforeach
                </ul>

                <h5>Días:</h5>
                <ul>
                    @foreach ($modalidad->dias as $dia)
                    <li>{{ $dia->dia }}</li>
                    @endforeach
                </ul>

                <h5>Ventajas:</h5>
                <ul>
                    @foreach ($modalidad->ventajas as $ventaja)
                    <li>{{ $ventaja->ventaja }}: {{ $ventaja->detalle }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
        @endforeach
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
