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

        @foreach ($product->modalidades as $modalidad)
        <div class="card mb-4">
            <div class="card-header bg-primary text-white">
                <span class="fw-bold"><h1>{{ $modalidad->modalidad }}</h1></span>
                <span><h1>Bs {{ number_format($modalidad->inversion, 2) }}</h1></span>
            </div>
            <div class="card-body">
                <h5>Descripción:</h5>
                <p>{{ $modalidad->descripcion }}</p>

                <h5>Seleccione un horario:</h5>
                <ul class="list-group">
                    @foreach ($modalidad->horarios as $horario)
                        <li class="d-flex align-items-center">
                            @if ($horario->estado == 0)
                                <input type="checkbox" id="horario-{{ $horario->id }}" class="form-check-input me-2 horario-checkbox" 
                                    value="{{ $horario->horario }}" disabled>
                                <label for="horario-{{$horario->id }}" class="flex-grow-1 mb-0 text-muted">
                                    {{ $horario->horario }} - <span class="text-danger">(Sin cupos)</span>
                                </label>
                            @else
                                <input type="checkbox" id="horario-{{ $horario->id }}" class="form-check-input me-2 horario-checkbox" 
                                    value="{{ $horario->horario }}">
                                <label for="horario-{{ $horario->id }}" class="flex-grow-1 mb-0">
                                    {{ $horario->horario }}
                                </label>
                            @endif
                        </li>
                    @endforeach
                </ul>
                <h5>Días:</h5>
                <ul>
                    @foreach ($modalidad->dias as $dia)
                    <li>{{ $dia->dia }}</li>
                    @endforeach
                </ul>
                <h5>Características:</h5>
                <ul>
                    @foreach ($modalidad->ventajas as $ventaja)
                    <li>{{ $ventaja->ventaja }}: {{ $ventaja->detalle }}</li>
                    @endforeach
                </ul>
            </div>
            <div class="card-footer text-center">
                <a href="#" onclick="reservar('{{ $modalidad->modalidad }}')" class="btn btn-warning"><i class="fa-brands fa-whatsapp fa-beat" style="color: #2fc804;"></i></a>
                <button class="btn btn-success" onclick="reservar('{{ $modalidad->modalidad }}')">Reservar</button>
                <a href="{{ route("home") }}" class="btn btn-warning">Volver atras</a>
                <a href="{{ route("generarmodalidadpdf",$modalidad) }}" class="btn btn-info">Imprimir</a>
            </div>
        </div>
        @endforeach
    </div>

    <script>
        function reservar(modalidad) {
            const isLoggedIn = false; // Cambiar a `true` para simular usuario logueado.
            const phoneNumber = "59171039910";

            // Obtener los horarios seleccionados
            const horariosSeleccionados = Array.from(document.querySelectorAll('.horario-checkbox:checked'))
                .map(checkbox => checkbox.value)
                .join('\n');

            // Crear el mensaje
            let message = `*Hola, deseo reservar la modalidad:*\n ${modalidad}.\n`;
            if (horariosSeleccionados) {
                message += `*Horarios seleccionados:*\n${horariosSeleccionados}.`;
                message += "\n*Nivel:*\n {{$product->nombre}}";
            } else {
                message += `No seleccioné ningún horario.`;
            }

            
            // Abrir WhatsApp
            if (isLoggedIn) {
                const url = `https://wa.me/?text=${encodeURIComponent(message)}`;
                window.open(url, '_blank');
            } else {
                const url = `https://wa.me/${phoneNumber}?text=${encodeURIComponent(message)}`;
                window.open(url, '_blank');
            }
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