<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modalidades de {{ $product->nombre }}</title>
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
    <style>
        .card-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .btn-reservar {
            width: 100%;
            margin: 10px 0;
        }

        .text-right {
            text-align: right; /* Alinea el contenido del div a la derecha */
        }
        .text-right a {
            display: inline-block; /* Asegura que el enlace se respete como un elemento alineado */
        }

    </style>
</head>
<body>
    <div class="container mt-5">
        <img src="{{ url('images/logo.png') }}" alt="Logotipo">
        <h1 class="mb-4">Modalidades para: {{ $product->nombre }}</h1>
        
        <div class="text-right">
            <a href="{{ route('generarpdf',$product) }}" class="btn btn-success">Exportar PDF</a>
        </div>

        <div class="card mb-4">
            <div class="card-header bg-secondary text-white">
                <h4 class="mb-0">Horarios disponibles</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>Modalidad</th>
                                <th>Horario</th>
                                <th>Estado</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($product->modalidades as $modalidad)
                                @foreach ($modalidad->horarios as $horario)
                                    <tr>
                                        <td>{{ $modalidad->modalidad }}</td>
                                        <td>{{ $horario->horario }}</td>
                                        <td>
                                            @if ($horario->estado == 0)
                                                <span class="badge bg-danger">Sin cupos</span>
                                            @else
                                                <span class="badge bg-success">Disponible</span>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="card mb-4">
            <div class="card-header bg-primary text-white">
                <h4 class="mb-0">Modalidades</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>Modalidad</th>
                                <th>Descripción</th>
                                <th>Inversión (Bs)</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($product->modalidades as $modalidad)
                                <tr>
                                    <td>{{ $modalidad->modalidad }}</td>
                                    <td>{{ $modalidad->descripcion }}</td>
                                    <td>{{ number_format($modalidad->inversion, 2) }}</td>
                                    <td class="d-flex gap-2">
                                        <a href="#" class="btn btn-success btn-sm" title="Quiero este servicio" onclick="whatsappModalidad('{{ $modalidad->modalidad }}')">
                                            <i class="fab fa-whatsapp"></i>
                                        </a>
                                        <a href="{{ route('generarmodalidadpdf', $modalidad) }}" class="btn btn-info btn-sm" title="Convertir a PDF">
                                            PDF
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script>
        function whatsappModalidad(modalidad) {
            const phoneNumber = "59171039910"; // Ajusta con tu número / $info si está disponible en la vista
            const message = `Quiero este servicio: ${modalidad} (Nivel: {{$product->nombre}})`;
            const url = `https://wa.me/${phoneNumber}?text=${encodeURIComponent(message)}`;
            window.open(url, '_blank');
        }
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>




{{--  
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modalidades de {{ $product->nombre }}</title>
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
--}}