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
    
    <link rel="stylesheet" href="{{ asset('welcome/css/welcome.css')}}">
    <link rel="stylesheet" href="{{ asset('welcome/css/redes.css')}}">
    <link rel="stylesheet" href="{{ asset('welcome/css/footer.css')}}">

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
    </style>
</head>
<body>
    <!-- Loading Screen -->
    <div id="loading-screen" class="loading-screen">
        <div class="loading-spinner"></div>
    </div>

    <!-- Hero -->
    <header class="header">
      <div class="header-background"></div>
      <div class="container hero">
        <div>
          <div class="logo-container" style="margin-bottom:1rem;">
            <div class="logo-circle">
                @isset($info)
                    @if($info->logo)
                        <img class="logo-image" src="{{ asset('storage/' . $info->logo) }}" alt="{{ $info->company_name }} Logo" style="max-height:80px;">
                    @endif
                @endisset
            </div>
          </div>
          <h1 class="main-title" style="color:var(--brand-blue);">{{ $info->company_name }}</h1>
          <p class="main-subtitle" style="color:var(--text-muted);">{{ $info->slogan }}</p>
          <div class="cta">
            <a href="https://wa.me/{{$info->code.$info->phone}}?text=Hola%2C%20quisiera%20más%20información" target="_blank" class="btn-primary"><i class="fab fa-whatsapp"></i> Consultar por WhatsApp</a>
            <a href="#productos" class="btn-primary" style="background:var(--brand-blue)"><i class="fa-solid fa-list"></i> Ver productos</a>
          </div>
        </div>
        <div class="stat">
          <div style="font-weight:700; color:var(--brand-blue);">Apoyo Escolar Integral</div>
          <div style="font-size:.9rem; color:var(--text-muted);">Inicial • Primaria • Secundaria</div>
          <hr>
          <div style="display:flex; gap:.75rem; justify-content:space-between;">
            <div>
              <div style="font-weight:700;">Modalidades</div>
              <div style="color:var(--text-muted);">Hora libre a trimestral</div>
            </div>
            <div>
              <div style="font-weight:700;">Plan de estudio</div>
              <div style="color:var(--text-muted);">Reporte y seguimiento</div>
            </div>
          </div>
        </div>
      </div>
    </header>

    <!-- Redes Sociales -->
    <section class="redes-sociales-dinamicas">
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
                            <p class="product-description" style="color:var(--text-muted);">Modalidades y contenidos por nivel. Preparación para evaluaciones.</p>
                            <div class="product-footer">
                                <span class="product-price">Bs. {{ $product->price }}</span>
                                <a href="{{ route('modalidades', $product->id) }}" class="btn-primary" title="Ver curso">Ver curso</a>
                                <a class="btn-primary" href="https://wa.me/{{$info->code.$info->phone}}?text=¡Hola!%20Estoy%20interesado%20en%20el%20producto%20{{ urlencode($product->nombre) }}.%20¿Me%20puedes%20dar%20más%20información?" target="_blank" title="Enviar por WhatsApp">
                                    <i class="fab fa-whatsapp"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Testimonials -->
    <section class="animate-fade-in-up" style="padding:2rem 0;">
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
    <section class="animate-fade-in-up" style="padding:2rem 0;">
      <div class="container">
        <div class="contact-strip">
          <div>
            <div style="font-weight:700; color:var(--brand-blue);">¿Listo para empezar?</div>
            <div style="color:var(--text-muted);">Escríbenos y arma tu plan hoy.</div>
          </div>
          <div>
            <a href="https://wa.me/{{$info->code.$info->phone}}?text=Hola%2C%20quisiera%20iniciar%20mi%20plan%20de%20estudio" target="_blank" class="btn-primary"><i class="fab fa-whatsapp"></i> Contactar</a>
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

    <script src="{{ asset('welcome/js/welcome.js')}}"></script>
    <script src="{{ asset('welcome/js/redes.js')}}"></script>
    <script src="{{ asset('welcome/js/footer.js')}}"></script>
</body>
</html>