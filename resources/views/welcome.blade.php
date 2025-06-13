<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $info->company_name }}</title>
    <meta name="description" content="Tarjeta personal digital interactiva con información de contacto, servicios y productos">
    <meta name="author" content="María González">
    <meta name="keywords" content="tarjeta digital, contacto, servicios, productos, profesional">
    
    <!-- Open Graph Meta Tags -->
    <meta property="og:title" content="Tarjeta Personal Digital - María González">
    <meta property="og:description" content="Descubre mis servicios profesionales y ponte en contacto conmigo">
    <meta property="og:type" content="website">
    
    <!-- Favicons -->
    <link rel="icon" type="image/x-icon" href="data:image/svg+xml,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 100 100'><text y='.9em' font-size='90'>💼</text></svg>">
    <meta name="theme-color" content="#1e3a8a">
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Font Awesome para iconos -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <link rel="stylesheet" href="{{ asset('welcome/css/welcome.css')}}">
    <link rel="stylesheet" href="{{ asset('welcome/css/redes.css')}}">
    <link rel="stylesheet" href="{{ asset('welcome/css/footer.css')}}">
</head>
<body>
    <!-- Loading Screen -->
    <div id="loading-screen" class="loading-screen">
        <div class="loading-spinner"></div>
    </div>

    <!-- Header -->
    <header class="header">
        <div class="header-background"></div>
        <div class="header-content">
            <div class="logo-container animate-fade-in-up">
                <div class="logo-circle">
                    @isset($info)
                        @if($info->logo)
                            <img class="logo-image" src="{{ asset('storage/' . $info->logo) }}" alt="{{ $info->company_name }} Logo">
                        @endif
                    @endisset
                </div>
            </div>
            <h1 class="main-title animate-fade-in-up">{{ $info->company_name }}</h1>
            <p class="main-subtitle animate-fade-in-up">{{ $info->slogan }}</p>
            <div class="header-decoration animate-fade-in-up"></div>
        </div>
    </header>

    
     <section class="redes-sociales-dinamicas">
        <div class="container">
            <h2 class="titulo-redes">Síguenos en Redes Sociales</h2>
            <div class="redes-grid" id="redes-container">
                @foreach ($socials as $social)
                    <a href="{{ $social->link }}" 
                        class="red-social-item" 
                        target="_blank" 
                        rel="noopener noreferrer"
                        style="animation-delay: ${index * 0.1}s">
                        <div class="red-social-contenido">
                            <div class="icono-red-social" style="background-color:{{ $social->color }};">
                                <i class="{{ $social->icon }}"></i>
                            </div>
                            <div class="red-social-info">
                                <h3 class="nombre-red-social">{{ $social->social }}</h3>
                                
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Contact Section -->
   

    <!-- Products Catalog -->
    <section class="products-section animate-fade-in-up">
        <div class="container">
            <h2 class="section-title">Nuestros Productos & Servicios</h2>
            
            <div class="products-grid" id="products-grid">
                @foreach ($products as $product)
                    <div class="product-card animate-fade-in-up">
                        <div class="product-image-container">
                            <img src="{{ asset('storage/'.$product->imagen) }}" alt="{{ $product->nombre }}" class="product-image">
                            <div class="product-image-overlay"></div>
                        </div>
                        <div class="product-content">
                            <h3 class="product-title">{{ $product->nombre }}</h3>
                            <p class="product-description">{{ $product->nombre }}</p>
                            <div class="product-footer">
                                <span class="product-price">Bs. {{ $product->price }}</span>
                                
                                <a class="btn-primary" href="https://wa.me/{{$info->code.$info->phone}}?text=¡Hola!%20Estoy%20interesado%20en%20el%20producto%20{{ urlencode($product->nombre) }}.%20¿Me%20puedes%20dar%20más%20información?" target="_blank" class="btn btn-whatsapp" title="Enviar por WhatsApp">
                                    <i class="fab fa-whatsapp"></i>
                                </a>

                                <!-- <button class="btn-primary" onclick="consultarProducto('${producto.nombre}')">
                                    Consultar
                                </button> -->
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            {{-- /%%%%%%%%%%%%%%%%%%% --}}
            {{-- @if(count($products)>0)
                @foreach ($products as $product)
                    <div class="card">
                        <div class="card-header" style="background-color:teal">
                            <h2>{{ $product->nombre }}</h2>
                        </div>
                        <div class="card-body">
                            <p>Bs. {{ $product->price }}</p>
                            <img class="product-imagen" src="{{ asset('storage/'.$product->imagen) }}" alt="Imagen">
                            <div class="button-container">
                                <a href="https://wa.me/{{$info->code.$info->phone}}?text=¡Hola!%20Estoy%20interesado%20en%20el%20producto%20{{ urlencode($product->nombre) }}.%20¿Me%20puedes%20dar%20más%20información?" target="_blank" class="btn btn-whatsapp" title="Enviar por WhatsApp">
                                    <i class="fab fa-whatsapp"></i>
                                </a>&#160;
                                <!-- <a href="{{route('modalidades',$product->id)}}" class="btn btn-detalle" title="Ver mas información">
                                    <i class="fa-solid fa-list">Detalle</i>
                                </a> -->

                            </div>
                        </div>
                    </div>
                @endforeach
        
            @else
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    <strong>No hay </strong>productos.
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif --}}
            {{-- /%%%%%%%%%%%%%%%%%%% --}}


        </div>
    </section>

{{-- 
     <section class="contact-section animate-fade-in-up">
        <div class="container">
            <h2 class="section-title">Ponte en Contacto</h2>
            
            <div class="contact-grid">
                <!-- Información de contacto -->
                <div class="contact-info">
                    <div class="contact-item">
                        <i class="fas fa-phone contact-icon"></i>
                        <div class="contact-details">
                            <h3>Teléfono</h3>
                            <a href="+{{ $info->phone }}" class="contact-link">{{ $info->phone }}</a>
                        </div>
                    </div>
                    
                    <div class="contact-item">
                        <i class="fas fa-envelope contact-icon"></i>
                        <div class="contact-details">
                            <h3>Email</h3>
                            <a href="" class="contact-link">{{ $info->address }}</a>
                        </div>
                    </div>
                </div>

                <!-- Redes sociales -->
                <div class="social-section">
                    <h3>Sígueme en</h3>
                    <div class="social-links">
                        <a href="https://facebook.com/@ite_educabol" class="social-link" target="_blank" rel="noopener">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="https://instagram.com/usuario" class="social-link" target="_blank" rel="noopener">
                            <i class="fab fa-instagram"></i>
                        </a>
                        <a href="https://wa.me/5551234567" class="social-link" target="_blank" rel="noopener">
                            <i class="fab fa-whatsapp"></i>
                        </a>
                        <a href="https://youtube.com/c/usuario" class="social-link" target="_blank" rel="noopener">
                            <i class="fab fa-youtube"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section> --}}


    <!-- Footer -->
    <footer class="footer-custom">
    <div class="footer-custom-container">
        <!-- Información de la empresa -->
        <div class="footer-custom-section footer-custom-company-info">
            <div class="logo-container animate-fade-in-up">
                <div class="footer-custom-company-logo logo-circle-custom">
                    <img src="{{ asset('storage/' . $info->logo) }}" alt="Logo de {{ $info->company_name }}" id="company-logo" class="logo-image">
                </div>

            </div>
            <h3 id="company-name">{{ $info->company_name }}</h3>
            @if($info->slogan)
                <p id="company-slogan">{{ $info->slogan }}</p>
            @endif
            @if($info->description)
                <p id="company-description">{{ $info->description }}</p>
            @endif
        </div>

        <!-- Información de contacto -->
        <div class="footer-custom-section footer-custom-contact-info">
            <h4>Información de Contacto</h4>
            @if($info->address)
                <div class="footer-custom-contact-item">
                    <i class="fas fa-map-marker-alt"></i>
                    <span id="company-address">{{ $info->address }}</span>
                </div>
            @endif
            @if($info->phone)
                <div class="footer-custom-contact-item">
                    <i class="fas fa-phone"></i>
                    <span id="company-phone">{{ $info->phone }}</span>
                </div>
            @endif
            @if($info->mail)
                <div class="footer-custom-contact-item">
                    <i class="fas fa-envelope"></i>
                    <span id="company-email">{{ $info->mail }}</span>
                </div>
            @endif
        </div>

        <!-- Redes sociales -->
        <div class="footer-custom-section footer-custom-social-media">
            <h4>Síguenos en Redes Sociales</h4>
            <div class="footer-custom-social-icons" id="social-icons">
                @foreach($socials as $social)
                    @if($social->state)
                        <a href="{{ $social->link }}" 
                           class="footer-custom-social-icon {{ $social->social }}" 
                           target="_blank" 
                           rel="noopener noreferrer"
                           title="Síguenos en {{ ucfirst($social->social) }}"
                           style="background-color: {{ $social->color }};">
                            <i class="{{ $social->icon }}"></i>
                        </a>
                    @endif
                @endforeach
            </div>
        </div>
    </div>

    <!-- Línea divisoria -->
    <div class="footer-custom-divider"></div>

    <!-- Copyright -->
    <div class="footer-custom-bottom">
        <p>&copy; {{ date('Y') }} <span id="copyright-company-name">{{ $info->company_name }}</span>. Todos los derechos reservados.</p>
    </div>
</footer> 


    <script src="{{ asset('welcome/js/welcome.js')}}"></script>
    <script src="{{ asset('welcome/js/redes.js')}}"></script>
    <script src="{{ asset('welcome/js/footer.js')}}"></script>
</body>
</html>