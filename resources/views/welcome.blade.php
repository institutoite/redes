<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>itelinker</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    
    <link rel="stylesheet" href="{{  asset('assets/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{  asset('assets/css/templatemo.css')}}">
    <link rel="stylesheet" href="{{  asset('assets/css/custom.css')}}">
    <link rel="icon" href="{{ asset('storage/logo.png') }}" type="image/x-icon"> <!-- Agrega el favicon aquí -->

    <style>
        body {
    font-family: Arial, sans-serif;
    background-color: #f4f4f4;
    margin: 0;
    padding: 20px;
}

.container {
    max-width: 1200px;
    margin: 0 auto;
    background-color: #fff;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

h1 {
    text-align: center;
    color: #333;
}

.cards-container {
    display: flex;
    flex-wrap: wrap;
    gap: 20px;
    justify-content: center;
}

.card {
    background-color: #fff;
    border-radius: 8px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    overflow: hidden;
    width: 300px;
    transition: transform 0.3s, box-shadow 0.3s;
    text-decoration: none;
    color: inherit;
}

.card:hover {
    transform: translateY(-10px);
    box-shadow: 0 12px 16px rgba(0, 0, 0, 0.2);
}

.card-header {
    color: #fff;
    padding: 20px;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.card-header h2 {
    margin: 0;
    font-size: 1.5em;
}

.card-header i {
    font-size: 2em;
}

.card-body {
    padding: 20px;
    background-color: #f9f9f9;
}

.card-body p {
    margin: 0;
    font-size: 1.1em;
    color: #333;
}
a{
    color: #007bff;
    text-decoration: none;
    transition: color 0.3s;
}
.product-imagen{
    width: 100%;
    height: 200px;
}
.map-container {
            margin: 20px 0;
        }
        .map {
            height: 300px;
            width: 100%;
        }
        .location-info {
            border: 1px solid #ccc;
            padding: 10px;
            margin: 10px 0;
            border-radius: 5px;
            background-color: #f9f9f9;
        }
        .map {
            height: 300px; /* Ajusta la altura del mapa según tus necesidades */
            width: 100%; /* Ajusta el ancho del mapa según tus necesidades */
            margin-bottom: 20px; /* Espacio entre mapas */
        }
        .location {
            margin-bottom: 10px;
            padding: 10px;
            border: 1px solid #ccc;
        }

        /* header*/
        .header {
            background-color: #403934;
            color: #ffffff;
            padding: 20px;
            text-align: center;
            border-bottom: 1px solid #dee2e6;
        }
        .header img {
            max-height: 80px;
            vertical-align: middle;
        }
        .header h1 {
            margin: 10px 0;
            font-size: 24px;
        }
        .auth-links {
            display: flex;
            justify-content: center;
            margin-top: 20px;
        }
        .auth-links a {
            margin: 0 15px;
            text-decoration: none;
            color: #007bff;
            font-weight: bold;
        }
        .auth-links a:hover {
            text-decoration: underline;
        }
        .auth-form {
            max-width: 400px;
            margin: 0 auto;
            padding: 20px;
            background: #ffffff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            margin-top: 20px;
        }
        .auth-form h2 {
            margin-bottom: 20px;
        }
        .auth-form input {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ced4da;
            border-radius: 4px;
        }
        .auth-form button {
            width: 100%;
            padding: 10px;
            border: none;
            border-radius: 4px;
            background-color: #007bff;
            color: #ffffff;
            font-size: 16px;
        }
        .auth-form button:hover {
            background-color: #0056b3;
        }
        .logo{
            width: 100px;
        }
        /*footer */

        a:hover{
            /* text-decoration: underline; */
            /* color: #0056b3; */
            
        }


        /*whatsapp*/
        .card {
        /* Asegúrate de que la tarjeta tenga un ancho definido si es necesario */
       
        margin: 0 auto; /* Centra la tarjeta en su contenedor */
        border: 1px solid #ddd; /* Opcional: Añade un borde */
        border-radius: 8px; /* Opcional: Añade bordes redondeados */
        overflow: hidden; /* Opcional: Evita que el contenido se desborde */
    }

    .card-body {
        padding: 16px;
        text-align: center; /* Asegúrate de que el texto dentro de la tarjeta esté centrado */
    }

    .button-container {
        display: flex;
        justify-content: center; /* Centra el botón horizontalmente */
        margin-top: 10px; /* Espacio arriba del botón */
    }

    .btn-whatsapp {
        display: inline-flex;
        align-items: center;
        background-color:#128C7E ; /* Color de WhatsApp */
        color: white;
        padding: 6px 12px; /* Tamaño más pequeño */
        border-radius: 4px;
        text-decoration: none;
        font-size: 14px; /* Tamaño de fuente más pequeño */
        margin-top: 10px;
    }

    .btn-whatsapp i {
        margin-right: 6px; /* Espacio entre ícono y texto */
    }

    .btn-whatsapp:hover {
        background-color: #25D366; /* Color verde oscuro de WhatsApp */
    }
    </style>
</head>
<body>
    


  
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">
                @isset($info)
                    @if($info->logo)
                        <img class="logo" src="{{ asset('storage/' . $info->logo) }}" alt="{{ $info->company_name }} Logo" style="max-height: 40px; vertical-align: middle;">
                    @endif
                @endisset

            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="{{ route('home') }}">preguntas frecuentes</a>
                    </li>
                </ul>
                
                <div class="d-flex ms-3">
                    @auth
                    <form action="{{ route('logout') }}" method="POST" class="d-inline">
                        @csrf
                        <button type="submit" class="btn btn-outline-danger">Salir</button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="btn btn-outline-success" data-bs-toggle="modal" data-bs-target="#loginModal">Ingresar</a>
                @endauth
                
                </div>
            </div>
        </div>
    
        <!-- Login Modal -->
        <div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="loginModalLabel">Login</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form method="POST" action="{{ route('login') }}">
                            @csrf
                            <div class="mb-3">
                                <label for="email" class="form-label">Email address</label>
                                <input type="email" class="form-control" id="email" name="email" required>
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" class="form-control" id="password" name="password" required>
                            </div>
                            <div class="mb-3 form-check">
                                <input type="checkbox" class="form-check-input" id="remember" name="remember">
                                <label class="form-check-label" for="remember">Remember me</label>
                            </div>
                            <button type="submit" class="btn btn-primary">Login</button>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    
        <!-- Register Modal -->
        <div class="modal fade" id="registerModal" tabindex="-1" aria-labelledby="registerModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="registerModalLabel">Register</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form method="POST" action="{{ route('register') }}">
                            @csrf
                            <div class="mb-3">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" class="form-control" id="name" name="name" required>
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email address</label>
                                <input type="email" class="form-control" id="email" name="email" required>
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" class="form-control" id="password" name="password" required>
                            </div>
                            <div class="mb-3">
                                <label for="password_confirmation" class="form-label">Confirm Password</label>
                                <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Register</button>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </nav>
    

    




    <div class="container">
        <h1>Socials</h1>
        <div class="cards-container">
            @foreach ($socials as $social)
                <a href="{{ $social->link }}">
                    <div class="card">
                        <div class="card-header" style="background-color: {{ $social->color }};">
                            <h2>{{ $social->social }}</h2>
                            <i class="{{ $social->icon }}"></i>
                        </div>
                    </div>
                </a>
            @endforeach
        </div>
        <h1>PRODUCTOS</h1>
        <div class="cards-container">
            @if(count($products)>0)
                @foreach ($products as $product)
                    <div class="card">
                        <div class="card-header" style="background-color:teal">
                            <h2>{{ $product->nombre }}</h2>
                        </div>
                        <div class="card-body">
                            <p>Bs. {{ $product->price }}</p>
                            <img class="product-imagen" src="{{ asset('storage/'.$product->imagen) }}" alt="Imagen">
                            <div class="button-container">
                                <a href="https://wa.me/?text=¡Hola!%20Estoy%20interesado%20en%20el%20producto%20{{ urlencode($product->nombre) }}.%20¿Me%20puedes%20dar%20más%20información?" target="_blank" class="btn btn-whatsapp" title="Enviar por WhatsApp">
                                    <i class="fab fa-whatsapp"></i> Enviar
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
        
            @else
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    <strong>No hay </strong>productos.
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
        </div>


        <div class="row">
            <div class="card-header" style="background-color:teal">
                UBICACION
            </div>
            <div class="card-body">
                <div id="locations">
                </div>
            </div>
        </div>
        <footer class="bg-dark" id="tempaltemo_footer">
            <div class="container-fluid">
                <div class="row">
    
                    <div class="col-md-4 pt-5">
                        <h2 class="h2 text-success border-bottom pb-3 border-light logo">{{ $info->company_name }}</h2>
                        <ul class="list-unstyled text-light footer-link-list">
                            <li>
                                <i class="fas fa-map-marker-alt fa-fw"></i>
                                {{ $info->address }}
                            </li>
                            <li>
                                <i class="fa fa-phone fa-fw"></i>
                                <a class="text-decoration-none" href="tel:010-020-0340">{{ $info->phone }}</a>
                            </li>
                            <li>
                                <i class="fa fa-envelope fa-fw"></i>
                                <a class="text-decoration-none" href="mailto:info@company.com">{{  $info->web }}</a>
                            </li>
                        </ul>
                    </div>
    
                    <div class="col-md-4 pt-5">
                        <h2 class="h2 text-light border-bottom pb-3 border-light">Redes Sociales</h2>
                        <ul class="list-unstyled text-light footer-link-list">
    
                            @foreach ($socials as $social)
                                <li><a class="text-decoration-none" href="{{ $social->link }}">{{ $social->social }}</a></li>
                            @endforeach
                        </ul>
                    </div>
    
                    <div class="col-md-4 pt-5">
                        <h2 class="h2 text-light border-bottom pb-3 border-light">Productos</h2>
                        <ul class="list-unstyled text-light footer-link-list">
                            @foreach ($products as $producto)
                                <li><a class="text-decoration-none" href="#">{{ $producto->nombre }}</a></li>
                            @endforeach
                            
                        </ul>
                    </div>
    
                </div>
    
                <div class="row text-light mb-4">
                    <div class="col-12 mb-3">
                        <div class="w-100 my-3 border-top border-light"></div>
                    </div>
                    <div class="col-auto me-auto">
                        <ul class="list-inline text-left footer-icons">
                            @foreach ($socials as $social)
                                
                                <li class="list-inline-item border border-light rounded-circle text-center">
                                    <a class="text-light text-decoration-none" target="_blank" href="{{ $social->social }}"><i class="{{ $social->icono }}"></i></a>
                                </li>
                            @endforeach
                            
                        </ul>
                    </div>
                    
                </div>
            </div>
    
            <div class="w-100 bg-black py-3">
                <div class="container-fluid">
                    <div class="row pt-2">
                        <div class="col-12">
                            <p class="text-left text-light">
                                Copyright &copy; 2024 ite educabol 
                                | Diseñado por <a rel="sponsored" href="https://ite.com.bo" target="_blank">David Flores</a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
    
        </footer>
    </div>

    <script src="{{ asset('assets/js/jquery-1.11.0.min.js')}}"></script>
    <script src="{{ asset('assets/js/jquery-migrate-1.2.1.min.js')}}"></script>
    <script src="{{ asset('assets/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{ asset('assets/js/templatemo.js')}}"></script>
    <script src="{{ asset('assets/js/custom.js')}}"></script>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/5.3.0/js/bootstrap.min.js"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBPa1FsDDCOpHUNfy3vA5a1MdR-WbAmEOM"></script>
    <script>
        function initMap() {
            var locationsContainer = document.getElementById('locations');
            @foreach ($locations as $location)
                var locationDiv = document.createElement('div');
                locationDiv.className = 'location';
                var mapDiv = document.createElement('div');
                mapDiv.className = 'map';
                locationDiv.appendChild(mapDiv);
                var infoDiv = document.createElement('div');
                infoDiv.innerHTML = '<b>{{ $location->nombre }}</b><br>{{ $location->direccion }}';
                locationDiv.appendChild(infoDiv);
                locationsContainer.appendChild(locationDiv);
                (function(mapDiv, location) {
                    console.log(location);
                    var map = new google.maps.Map(mapDiv, {
                        zoom:location.zoom, // Nivel de zoom para cada mapa
                        center: {lat: location.latitud, lng: location.longitud} // Centro del mapa en la ubicación
                    });
                    var marker = new google.maps.Marker({
                        position: {lat: location.latitud, lng: location.longitud},
                        map: map,
                        title: location.titulo
                    });
                    var infowindow = new google.maps.InfoWindow({
                        content: '<b>' + location.nombre + '</b><br>' + location.direccion
                    });
                    marker.addListener('click', function() {
                        infowindow.open(map, marker);
                    });
                })(mapDiv, {
                    latitud: {{ $location->latitud }},
                    longitud: {{ $location->longitud }},
                    zoom: {{ $location->zoom }},
                    nombre: "{{ $location->titulo }}",
                    direccion: "{{ $location->direccion }}"
                });
            @endforeach
        }
        google.maps.event.addDomListener(window, 'load', initMap);
    </script>
</body>
</html>
