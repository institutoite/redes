<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $info->company_name }} — Educación y Apoyo</title>
    <meta name="description" content="{{ $info->company_name }}: Apoyo escolar profesional con modalidades flexibles, materiales y contenidos por niveles.">
    <meta name="author" content="{{ $info->company_name }}">
    <meta name="keywords" content="apoyo escolar, primaria, secundaria, inicial, educación, clases, evaluaciones, contenidos, materiales">

    <!-- Open Graph Meta Tags -->
    <meta property="og:title" content="{{ $info->company_name }} — Educación y Apoyo">
    <meta property="og:description" content="Modalidades flexibles, plan de estudio y preparación de evaluaciones.">
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
    <!-- Nuevo CSS específico del header -->
    <link rel="stylesheet" href="{{ asset('welcome/css/header.css') }}?v=2">
    <link rel="stylesheet" href="{{ asset('welcome/css/welcome.css') }}?v=2">
    <link rel="stylesheet" href="{{ asset('welcome/css/redes.css') }}?v=2">
    <link rel="stylesheet" href="{{ asset('welcome/css/footer.css') }}?v=2">

    <style>
      :root { --brand-teal: rgb(38,186,165); --brand-blue: rgb(55,95,122); --text-dark:#0f172a; --text-muted:#64748b; }
      body { font-family: 'Inter', system-ui, -apple-system, Segoe UI, Roboto, sans-serif; color: var(--text-dark); }
      .btn-primary { background: var(--brand-teal); color:#fff; border:none; padding:.6rem 1rem; border-radius:.5rem; transition:.2s; }
      .btn-primary:hover { filter: brightness(0.95); }
      .header { position: relative; overflow: hidden; }
      .header-background { position:absolute; inset:0; background: linear-gradient(135deg, var(--brand-blue), var(--brand-teal)); opacity:.15; }
      .hero { display:grid; grid-template-columns: 1.2fr .8fr; gap:2rem; align-items:center; padding: 3rem 0; }
      .hero .cta { display:flex; gap:.75rem; flex-wrap:wrap; }
      .stat { background:#fff; border:1px solid rgba(55,95,122,.15); border-radius:.75rem; padding:1rem; text-align:center; }
      .section-title { font-weight:700; color: var(--brand-blue); margin-bottom:1rem; }
      .features-grid { display:grid; grid-template-columns: repeat(3,1fr); gap:1rem; }
      .feature-card { border:1px solid rgba(55,95,122,.15); border-radius:.75rem; padding:1rem; background:#fff; }
      .products-grid { display:grid; grid-template-columns: repeat(3,1fr); gap:1.2rem; }
      .product-card { border:1px solid rgba(55,95,122,.15); border-radius:.75rem; overflow:hidden; background:#fff; }
      .product-image-container { position:relative; height:180px; overflow:hidden; }
      .product-image { width:100%; height:100%; object-fit:cover; }
      .product-content { padding:1rem; }
      .testimonial-grid { display:grid; grid-template-columns: repeat(2,1fr); gap:1rem; }
      .testimonial { background:#fff; border:1px solid rgba(55,95,122,.15); border-radius:.75rem; padding:1rem; }
      .contact-strip { background: rgba(38,186,165,.08); border:1px solid rgba(38,186,165,.25); border-radius:.75rem; padding:1rem; display:flex; align-items:center; justify-content:space-between; }
      @media (max-width: 992px) {
        .hero { grid-template-columns: 1fr; }
        .features-grid, .products-grid { grid-template-columns: repeat(2,1fr); }
        .testimonial-grid { grid-template-columns: 1fr; }
      }
      @media (max-width: 576px) {
        .features-grid, .products-grid { grid-template-columns: 1fr; }
      }

      /** Loading Screen Styles **/
      /* Header general */
      .site-header {
        position: relative;
        overflow: hidden;
        color: white;
      }

      .header-bg {
        position: absolute;
        inset: 0;
        background: linear-gradient(135deg, #1e3a5f, #2c7a7b);
        z-index: -2;
      }

      .header-top {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 1.5rem 0;
        position: relative;
        z-index: 2;
      }

      .header-brand {
        display: flex;
        align-items: center;
        gap: 1rem;
      }

      .brand-emblem img {
        height: 60px;
        width: auto;
        object-fit: contain;
      }

      .brand-text {
        display: flex;
        flex-direction: column;
      }

      .brand-text h1 {
        margin: 0;
        font-size: 1.8rem;
        font-weight: 700;
      }

      .brand-slogan {
        margin: 0.25rem 0 0;
        font-size: 1rem;
        opacity: 0.9;
        font-style: italic;
      }

      /* Navegación */
      .header-nav {
        display: flex;
        gap: 0.5rem;
        flex-wrap: wrap;
      }

      .nav-pill {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        padding: 0.75rem 1.25rem;
        background: rgba(255, 255, 255, 0.15);
        border-radius: 50px;
        color: white;
        text-decoration: none;
        font-weight: 500;
        transition: all 0.3s ease;
        backdrop-filter: blur(10px);
      }

      .nav-pill:hover {
        background: rgba(255, 255, 255, 0.25);
        transform: translateY(-2px);
      }

      .nav-pill i {
        font-size: 1.1rem;
      }

      .nav-login {
        background: rgba(255, 255, 255, 0.25);
        font-weight: 600;
      }

      /* Sección hero con citas */
      .quotes-hero {
        position: relative;
        min-height: 400px;
        display: flex;
        align-items: center;
        justify-content: center;
        text-align: center;
        overflow: hidden;
      }

      .quotes-hero-bg {
        position: absolute;
        inset: 0;
        background: url('/images/hero-education-bg.jpg') center/cover no-repeat; /* Cambia por tu imagen */
        z-index: -2;
      }

      .quotes-hero-overlay {
        position: absolute;
        inset: 0;
        background: linear-gradient(rgba(55,95,122,.4), rgba(38,186,165,.4));
        z-index: -1;
      }

      .quotes-hero-content {
        max-width: 900px;
        padding: 2rem;
        position: relative;
      }

      .quotes-hero-content i.fa-quote-left {
        font-size: 3rem;
        opacity: 0.4;
        margin-bottom: 1rem;
        display: block;
      }

      .quote-text {
        font-size: 2.2rem;
        line-height: 1.4;
        font-weight: 600;
        opacity: 0;
        transform: translateY(30px);
        transition: all 1.2s ease;
      }

      .quote-text.active {
        opacity: 1;
        transform: translateY(0);
      }

      /* Divisor */
      .header-divider {
        height: 4px;
        background: linear-gradient(90deg, transparent, #fff, transparent);
        opacity: 0.5;
        margin: 0 2rem;
      }

      /* Responsive */
      @media (max-width: 992px) {
        .quote-text {
          font-size: 1.8rem;
        }
      }

      @media (max-width: 768px) {
        .header-top {
          flex-direction: column;
          text-align: center;
          gap: 1.5rem;
        }

        .header-nav {
          justify-content: center;
        }

        .quote-text {
          font-size: 1.6rem;
        }

        .quotes-hero {
          min-height: 350px;
        }
      }

      @media (max-width: 480px) {
        .nav-pill {
          padding: 0.6rem 1rem;
          font-size: 0.9rem;
        }

        .nav-pill span {
          display: none;
        }

        .nav-pill i {
          font-size: 1.3rem;
        }
      }
    </style>
</head>
<body>
    <!-- Loading Screen -->
    <div id="loading-screen" class="loading-screen">
        <div class="loading-spinner"></div>
    </div>

    <!-- Header totalmente nuevo -->
    <header class="site-header header-v2" data-header>
      <div class="header-bg"></div>
      <div class="container header-top">
        <div class="header-brand">
          <div class="brand-emblem">
            @php
              $logoUrl = null;
              if (!empty($info?->logo)) {
                $pStorage = public_path('storage/'.$info->logo);
                $pPublic = public_path($info->logo);
                if (file_exists($pStorage)) {
                  $logoUrl = asset('storage/'.$info->logo);
                } elseif (file_exists($pPublic)) {
                  $logoUrl = asset($info->logo);
                }
              }
              if (!$logoUrl) {
                foreach (['images/logo.jpg','images/logo.png'] as $rel) {
                  if (file_exists(public_path($rel))) { $logoUrl = asset($rel); break; }
                }
              }
            @endphp
            @if($logoUrl)
              <img src="{{ $logoUrl }}" alt="Logo {{ $info->company_name }}">
            @endif
          </div>
          <div class="brand-text">
           
            <p class="brand-slogan">{{ $info->slogan }}</p>
          </div>
        </div>
        <nav class="header-nav" aria-label="Navegación principal">
          <a href="#productos" class="nav-pill"><i class="fa-solid fa-list" aria-hidden="true"></i><span>Productos</span></a>
          <a href="#redes" class="nav-pill"><i class="fa-solid fa-share-nodes" aria-hidden="true"></i><span>Redes</span></a>
          <a href="#opiniones" class="nav-pill"><i class="fa-solid fa-comments" aria-hidden="true"></i><span>Opiniones</span></a>
          <a href="#contacto" class="nav-pill"><i class="fa-solid fa-envelope" aria-hidden="true"></i><span>Contacto</span></a>
          <a href="{{ url('/admin') }}" class="nav-pill nav-login"><i class="fa-solid fa-right-to-bracket"></i><span>Login</span></a>
        </nav>
      </div>

      <!-- Frases poderosas de educación con fondo -->
      <section class="quotes-hero" aria-live="polite" data-quotes-hero
        style="background-image: linear-gradient(rgba(55,95,122,.25), rgba(38,186,165,.25));">
        <div class="quotes-hero-bg" data-quotes-bg></div>
        <div class="quotes-hero-overlay"></div>
        <div class="quotes-hero-content">
          <i class="fa-solid fa-quote-left" aria-hidden="true"></i>
          <h2 class="quote-text" data-quotes>
            "La educación es el arma más poderosa para cambiar el mundo." — Nelson Mandela
          </h2>
        </div>
      </section>

    

 

      <div class="header-divider" role="presentation"></div>
    </header>

    <!-- Redes Sociales -->
    <section id="redes" class="redes-sociales-dinamicas">
        <div class="container">
            <h2 class="titulo-redes">Síguenos en Redes Sociales</h2>
            <div class="redes-grid" id="redes-container">
                @foreach ($socials as $social)
                    <a href="{{ $social->link }}" 
                        class="red-social-item" 
                        target="_blank" 
                        rel="noopener noreferrer">
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

    <!-- Features -->
    <section class="animate-fade-in-up" style="padding:2rem 0;">
      <div class="container">
        <h2 class="section-title">¿Por qué elegirnos?</h2>
        <div class="features-grid">
          <div class="feature-card">
            <h3 style="color:var(--brand-blue);"><i class="fa-solid fa-user-check"></i> Clases personalizadas</h3>
            <p style="color:var(--text-muted);">Adaptamos el ritmo y contenidos a cada estudiante.</p>
          </div>
          <div class="feature-card">
            <h3 style="color:var(--brand-blue);"><i class="fa-solid fa-calendar-days"></i> Modalidades flexibles</h3>
            <p style="color:var(--text-muted);">Desde hora libre hasta plan trimestral (L-V).</p>
          </div>
          <div class="feature-card">
            <h3 style="color:var(--brand-blue);"><i class="fa-solid fa-chart-line"></i> Seguimiento y reporte</h3>
            <p style="color:var(--text-muted);">Plan de estudio y comunicación con familias.</p>
          </div>
        </div>
      </div>
    </section>

    <!-- Products Catalog -->
    <section id="productos" class="products-section animate-fade-in-up" style="padding:2rem 0;">
        <div class="container">
            <h2 class="section-title">Nuestros Productos & Servicios</h2>
            <div class="products-grid" id="products-grid">
                @foreach ($products as $product)
                    <div class="product-card animate-fade-in-up">
                        <div class="product-image-container">
                            <img src="{{ asset('storage/'.$product->imagen) }}" alt="{{ $product->nombre }}" class="product-image">
                        </div>
                        <div class="product-content">
                            <h3 class="product-title">{{ $product->nombre }}</h3>
                            <p class="product-description" style="color:var(--text-muted);">{{ $product->descripcion }}</p>
                            <div class="product-footer">
                                
                                <a href="{{ route('modalidades', $product->id) }}" class="btn-primary" title="Ver curso">Ver curso</a>
                                <a href="https://wa.me/{{$info->code.$info->phone}}?text=¡Hola!%20Estoy%20interesado%20en%20el%20servicio%20{{ urlencode($product->nombre) }}.%20¿Me%20puedes%20dar%20más%20información?" target="_blank" title="Enviar por WhatsApp">
                                    <i class="fa-brands fa-whatsapp fa-beat fa-2x" style="color: #0ec444;"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Testimonials -->
    <section id="opiniones" class="animate-fade-in-up" style="padding:2rem 0;">
      <div class="container">
        <h2 class="section-title">Opiniones</h2>
        <div class="testimonial-grid">
          @foreach(($testimonials ?? []) as $t)
            <div class="testimonial">
              <div style="font-weight:600; color:var(--brand-blue);">{{ $t->nombre ?? 'Estudiante' }}</div>
              <div style="color:var(--text-muted);">{{ $t->mensaje ?? '' }}</div>
            </div>
          @endforeach
          @if(empty($testimonials) || count($testimonials) === 0)
            <div class="testimonial">
              <div style="font-weight:600; color:var(--brand-blue);">Familias satisfechas</div>
              <div style="color:var(--text-muted);">Seguimiento constante y mejoras visibles en evaluaciones.</div>
            </div>
          @endif
        </div>
      </div>
    </section>

    <!-- Contact CTA -->
    <section id="contacto" class="animate-fade-in-up" style="padding:2rem 0;">
      <div class="container">
        <div class="contact-strip">
          <div>
            <div style="font-weight:700; color:var(--brand-blue);">¿Listo para empezar?</div>
            <div style="color:var(--text-muted);">Escríbenos y arma tu plan hoy.</div>
          </div>
          <div>
            <a href="https://wa.me/{{$info->code.$info->phone}}?text=Hola%2C%20quisiera%20iniciar%20mi%20plan%20de%20estudio" target="_blank" class=""><i class="fa-brands fa-whatsapp fa-beat fa-2x" style="color: #0ec444;"></i></a>
          </div>
        </div>
      </div>
    </section>

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

    <!-- Nuevo JS específico del header -->
    <script src="{{ asset('welcome/js/header.js') }}?v=2"></script>
    <script src="{{ asset('welcome/js/welcome.js') }}?v=2"></script>
    <script src="{{ asset('welcome/js/redes.js') }}?v=2"></script>
    <script src="{{ asset('welcome/js/footer.js') }}?v=2"></script>
    <script>
    document.addEventListener('DOMContentLoaded', function () {
  const quotes = [
    "La educación es el arma más poderosa para cambiar el mundo. — Nelson Mandela",
    "La educación no cambia el mundo, cambia a las personas que van a cambiar el mundo. — Paulo Freire",
    "Dime y lo olvido, enséñame y lo recuerdo, involúcrame y lo aprendo. — Benjamin Franklin",
    "La educación es el pasaporte hacia el futuro, el mañana pertenece a aquellos que se preparan para él hoy. — Malcolm X",
    "Educar la mente sin educar el corazón no es educación en absoluto. — Aristóteles",
    "Enseñar es aprender dos veces. — Joseph Joubert",
    "La educación es lo que sobrevive cuando lo aprendido ha sido olvidado. — B.F. Skinner"
  ];

  const quoteElement = document.querySelector('[data-quotes]');
  if (!quoteElement) return;

  let currentIndex = 0;

  function showNextQuote() {
    // Quitar clase active
    quoteElement.classList.remove('active');

    // Cambiar texto después de la transición de salida
    setTimeout(() => {
      currentIndex = (currentIndex + 1) % quotes.length;
      quoteElement.textContent = `"${quotes[currentIndex]}"`;
      quoteElement.classList.add('active');
    }, 600); // Tiempo para que termine la transición de salida
  }

  // Mostrar la primera cita inmediatamente
  quoteElement.textContent = `"${quotes[0]}"`;
  quoteElement.classList.add('active');

  // Cambiar cada 7 segundos
  setInterval(showNextQuote, 7000);
});  

</script>
    
</body>
</html>