<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>IFE Educabol | Formación y apoyo educativo</title>
    <meta name="description" content="IFE Educabol ofrece apoyo escolar, ciencias, idiomas, computación, programación, robótica y preparación para exámenes en Bolivia.">
    <meta name="author" content="IFE Educabol">
    <meta name="keywords" content="IFE Educabol, apoyo escolar, matemática, física, química, lenguaje, inglés, computación, programación, robótica, Bolivia">
    <meta name="theme-color" content="#26BAA5">
    <link rel="canonical" href="https://ife.bo/">

    <meta property="og:title" content="IFE Educabol | Aprende, crea y avanza">
    <meta property="og:description" content="Formación cercana y práctica para fortalecer habilidades, preparar evaluaciones y abrir nuevas oportunidades.">
    <meta property="og:type" content="website">
    <meta property="og:url" content="https://ife.bo/">
    <meta property="og:image" content="{{ asset('images/logo-ife-educabol-ofical-instituto-de-formacion-educabol.png') }}">
    <meta property="og:image:alt" content="Logo de IFE Educabol">
    <meta property="og:locale" content="es_BO">
    <meta property="og:site_name" content="IFE Educabol">

    <link rel="icon" type="image/png" href="{{ asset('images/icono-ife-educabol.png') }}">
    <link rel="apple-touch-icon" href="{{ asset('images/icono-ife-educabol.png') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/fontawesome.min.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('welcome/css/welcome.css') }}?v=ife-1">
</head>
<body data-page-name="Inicio de IFE Educabol">
    <div class="site-loader" id="site-loader" aria-hidden="true">
        <img src="{{ asset('images/icono-ife-educabol.png') }}" alt="">
        <span>Cargando IFE Educabol</span>
    </div>

    <header class="site-header" id="inicio">
        <div class="container nav-wrap">
            <a class="brand" href="#inicio" aria-label="IFE Educabol, ir al inicio">
                <img src="{{ asset('images/logo-ife-educabol-ofical-instituto-de-formacion-educabol.png') }}" alt="IFE Educabol">
            </a>
            <button class="nav-toggle" type="button" aria-expanded="false" aria-controls="main-nav" aria-label="Abrir menú">
                <i class="fa-solid fa-bars" aria-hidden="true"></i>
            </button>
            <nav class="main-nav" id="main-nav" aria-label="Navegación principal">
                <a href="#servicios">Servicios</a>
                <a href="#programas">Programas</a>
                <a href="#autor">Nosotros</a>
                <a href="#redes">Redes</a>
                <a href="{{ url('/admin') }}" class="nav-admin"><i class="fa-solid fa-user-lock" aria-hidden="true"></i> Acceso</a>
            </nav>
        </div>
    </header>

    <main>
        <section class="hero" aria-labelledby="hero-title">
            <div class="hero-shape hero-shape-one"></div>
            <div class="hero-shape hero-shape-two"></div>
            <div class="container hero-grid">
                <div class="hero-copy reveal">
                    <p class="eyebrow"><i class="fa-solid fa-graduation-cap" aria-hidden="true"></i> Formación que transforma</p>
                    <h1 id="hero-title">Aprende con confianza.<br><span>Avanza con propósito.</span></h1>
                    <p class="hero-lead">En IFE Educabol convertimos las dudas en habilidades con acompañamiento cercano, metodología práctica y programas pensados para cada etapa.</p>
                    <div class="hero-actions">
                        <a class="button button-primary" href="#programas">Explorar programas <i class="fa-solid fa-arrow-right" aria-hidden="true"></i></a>
                        <a class="button button-light js-whatsapp" href="#" target="_blank" rel="noopener noreferrer"><i class="fa-brands fa-whatsapp" aria-hidden="true"></i> Hablar con un asesor</a>
                    </div>
                    <div class="hero-points" aria-label="Ventajas de IFE Educabol">
                        <span><i class="fa-solid fa-circle-check" aria-hidden="true"></i> Atención personalizada</span>
                        <span><i class="fa-solid fa-circle-check" aria-hidden="true"></i> Horarios flexibles</span>
                    </div>
                </div>
                <div class="hero-visual reveal">
                    <div class="hero-image-frame">
                        <img src="{{ asset('images/isologo-ife-educabol-ofical-instituto-de-formacion-educabol.png') }}" alt="Símbolo educativo de IFE Educabol">
                    </div>
                    <div class="floating-card floating-card-top"><i class="fa-solid fa-lightbulb" aria-hidden="true"></i><span><strong>Aprendizaje práctico</strong>Para la vida real</span></div>
                    <div class="floating-card floating-card-bottom"><i class="fa-solid fa-chart-line" aria-hidden="true"></i><span><strong>Progreso continuo</strong>A tu propio ritmo</span></div>
                </div>
            </div>
        </section>

        <section class="trust-strip" aria-label="Propuesta educativa">
            <div class="container trust-grid">
                <div><i class="fa-solid fa-user-graduate" aria-hidden="true"></i><span><strong>Acompañamiento</strong> cercano y humano</span></div>
                <div><i class="fa-solid fa-book-open-reader" aria-hidden="true"></i><span><strong>Metodología</strong> clara y práctica</span></div>
                <div><i class="fa-solid fa-puzzle-piece" aria-hidden="true"></i><span><strong>Formación</strong> para cada necesidad</span></div>
            </div>
        </section>

        <section class="section services" id="servicios">
            <div class="container">
                <div class="section-heading reveal">
                    <p class="eyebrow">Todo lo que puedes aprender</p>
                    <h2>Servicios para construir un mejor futuro</h2>
                    <p>Refuerzo académico, habilidades digitales y herramientas para aprender de forma más efectiva.</p>
                </div>
                @php
                    $services = [
                        ['fa-people-roof', 'Apoyo escolar'], ['fa-square-root-variable', 'Matemática'],
                        ['fa-atom', 'Física'], ['fa-flask-vial', 'Química'], ['fa-book', 'Lenguaje'],
                        ['fa-language', 'Inglés'], ['fa-computer', 'Computación'], ['fa-code', 'Programación'],
                        ['fa-robot', 'Robótica'], ['fa-file-pen', 'Preparación para exámenes'],
                        ['fa-brain', 'Técnicas de estudio']
                    ];
                @endphp
                <div class="services-grid">
                    @foreach($services as [$icon, $name])
                        <article class="service-card reveal">
                            <span class="service-icon"><i class="fa-solid {{ $icon }}" aria-hidden="true"></i></span>
                            <h3>{{ $name }}</h3>
                        </article>
                    @endforeach
                </div>
            </div>
        </section>

        <section class="section programs" id="programas">
            <div class="container">
                <div class="section-heading heading-row reveal">
                    <div>
                        <p class="eyebrow">Elige cómo avanzar</p>
                        <h2>Nuestros programas</h2>
                    </div>
                    <p>Conoce las opciones disponibles y encuentra la modalidad adecuada para tus objetivos.</p>
                </div>
                <div class="programs-grid">
                    @forelse($products as $product)
                        <article class="program-card reveal">
                            <a class="program-image" href="{{ route('modalidades', $product->id) }}" aria-label="Ver {{ $product->nombre }}">
                                <img src="{{ asset('storage/'.$product->imagen) }}" alt="{{ $product->nombre }}" loading="lazy">
                                <span>Ver modalidades</span>
                            </a>
                            <div class="program-content">
                                <p class="program-label">Programa IFE</p>
                                <h3>{{ $product->nombre }}</h3>
                                <p>{{ $product->descripcion }}</p>
                                <div class="program-actions">
                                    <a class="text-link" href="{{ route('modalidades', $product->id) }}">Conocer programa <i class="fa-solid fa-arrow-right" aria-hidden="true"></i></a>
                                    <a class="wa-round js-whatsapp" href="#" data-context="Me interesa el programa {{ $product->nombre }}." target="_blank" rel="noopener noreferrer" aria-label="Consultar {{ $product->nombre }} por WhatsApp"><i class="fa-brands fa-whatsapp" aria-hidden="true"></i></a>
                                </div>
                            </div>
                        </article>
                    @empty
                        <div class="empty-state">
                            <i class="fa-solid fa-book-open" aria-hidden="true"></i>
                            <h3>Estamos preparando nuestros programas</h3>
                            <p>Escríbenos y te orientaremos personalmente.</p>
                            <a class="button button-primary js-whatsapp" href="#" target="_blank" rel="noopener noreferrer">Consultar por WhatsApp</a>
                        </div>
                    @endforelse
                </div>
            </div>
        </section>

        <section class="section author" id="autor">
            <div class="container author-card reveal">
                <div class="author-image">
                    <div class="author-orbit"></div>
                    <img src="{{ asset('images/david-flores-ife-educabol-instituto-formacion-educabol.png') }}" alt="David Flores, representante de IFE Educabol" loading="lazy">
                </div>
                <div class="author-copy">
                    <p class="eyebrow">Acerca del creador</p>
                    <h2>Educación y tecnología con sentido humano</h2>
                    <p>David Flores es creador de herramientas educativas y representante de IFE Educabol. Su trabajo une enseñanza, creatividad y tecnología para hacer que aprender sea más claro, útil y accesible.</p>
                    <p>Desde IFE Educabol impulsa soluciones cercanas que ayudan a estudiantes y familias a avanzar con seguridad.</p>
                    <a class="button button-outline js-whatsapp" href="#" data-context="Quisiera conocer más sobre las herramientas educativas de David Flores." target="_blank" rel="noopener noreferrer">Conversemos <i class="fa-brands fa-whatsapp" aria-hidden="true"></i></a>
                </div>
            </div>
        </section>

        <section class="section social-section" id="redes">
            <div class="container">
                <div class="section-heading reveal">
                    <p class="eyebrow">Nuestra comunidad</p>
                    <h2>Sigue aprendiendo con IFE Educabol</h2>
                    <p>Consejos, recursos y novedades educativas en nuestras redes oficiales.</p>
                </div>
                <div class="social-grid">
                    <a class="social-card reveal" href="https://www.tiktok.com/@ife_educabol" target="_blank" rel="noopener noreferrer"><i class="fa-brands fa-tiktok" aria-hidden="true"></i><span><strong>TikTok</strong>@ife_educabol</span><i class="fa-solid fa-arrow-up-right-from-square" aria-hidden="true"></i></a>
                    <a class="social-card reveal" href="https://www.facebook.com/ife.educabol" target="_blank" rel="noopener noreferrer"><i class="fa-brands fa-facebook-f" aria-hidden="true"></i><span><strong>Facebook</strong>ife.educabol</span><i class="fa-solid fa-arrow-up-right-from-square" aria-hidden="true"></i></a>
                    <a class="social-card reveal" href="https://www.youtube.com/@ife_educabol" target="_blank" rel="noopener noreferrer"><i class="fa-brands fa-youtube" aria-hidden="true"></i><span><strong>YouTube</strong>@ife_educabol</span><i class="fa-solid fa-arrow-up-right-from-square" aria-hidden="true"></i></a>
                    <a class="social-card reveal" href="https://www.instagram.com/ife_educabol" target="_blank" rel="noopener noreferrer"><i class="fa-brands fa-instagram" aria-hidden="true"></i><span><strong>Instagram</strong>@ife_educabol</span><i class="fa-solid fa-arrow-up-right-from-square" aria-hidden="true"></i></a>
                </div>
            </div>
        </section>

        <section class="section contact" id="contacto">
            <div class="container contact-card reveal">
                <div>
                    <p class="eyebrow">Estamos para orientarte</p>
                    <h2>¿Listo para dar el siguiente paso?</h2>
                    <p>Cuéntanos qué necesitas y te ayudaremos a elegir el programa ideal.</p>
                </div>
                <a class="button button-white js-whatsapp" href="#" target="_blank" rel="noopener noreferrer"><i class="fa-brands fa-whatsapp" aria-hidden="true"></i> Escribir al +591 75553338</a>
            </div>
        </section>
    </main>

    <footer class="site-footer">
        <div class="container footer-grid">
            <div class="footer-brand">
                <img src="{{ asset('images/logo-ife-educabol-ofical-instituto-de-formacion-educabol.png') }}" alt="IFE Educabol">
                <p>Formación cercana para aprender, crear y avanzar.</p>
            </div>
            <div>
                <h2>Explora</h2>
                <a href="#servicios">Servicios</a>
                <a href="#programas">Programas</a>
                <a href="#autor">Acerca de David</a>
            </div>
            <div>
                <h2>Contacto</h2>
                <a href="tel:+59175553338">+591 75553338</a>
                <a href="https://ife.bo/">ife.bo</a>
                @if(!empty($locations) && $locations->count())
                    <span>{{ $locations->first()->direccion }}</span>
                @endif
            </div>
            <div>
                <h2>Redes oficiales</h2>
                <div class="footer-socials">
                    <a href="https://www.tiktok.com/@ife_educabol" target="_blank" rel="noopener noreferrer" aria-label="TikTok"><i class="fa-brands fa-tiktok"></i></a>
                    <a href="https://www.facebook.com/ife.educabol" target="_blank" rel="noopener noreferrer" aria-label="Facebook"><i class="fa-brands fa-facebook-f"></i></a>
                    <a href="https://www.youtube.com/@ife_educabol" target="_blank" rel="noopener noreferrer" aria-label="YouTube"><i class="fa-brands fa-youtube"></i></a>
                    <a href="https://www.instagram.com/ife_educabol" target="_blank" rel="noopener noreferrer" aria-label="Instagram"><i class="fa-brands fa-instagram"></i></a>
                </div>
            </div>
        </div>
        <div class="container footer-bottom">
            <span>© {{ date('Y') }} IFE Educabol. Todos los derechos reservados.</span>
            <span>Educación que abre oportunidades.</span>
        </div>
    </footer>

    <a class="whatsapp-float js-whatsapp" href="#" target="_blank" rel="noopener noreferrer" aria-label="Contactar a IFE Educabol por WhatsApp">
        <i class="fa-brands fa-whatsapp" aria-hidden="true"></i>
        <span>¿Te ayudamos?</span>
    </a>

    <script src="{{ asset('welcome/js/welcome.js') }}?v=ife-1" defer></script>
</body>
</html>
