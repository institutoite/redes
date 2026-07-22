<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'IFE Educabol') | IFE Educabol</title>
    <meta name="description" content="Servicios y procesos de formación de IFE Educabol.">
    <meta name="theme-color" content="#26BAA5">
    <link rel="icon" type="image/png" href="{{ asset('images/icono-ife-educabol.png') }}">
    <link rel="stylesheet" href="{{ asset('footer.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css">
    <style>
        :root {
            --brand-teal: rgb(38,186,165);
            --brand-blue: rgb(55,95,122);
        }
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, var(--brand-blue) 0%, var(--brand-teal) 100%);
            color: var(--brand-blue);
        }
        .brand-btn {
            background: linear-gradient(90deg, var(--brand-teal) 0%, var(--brand-blue) 100%);
            color: #fff;
            border: none;
            border-radius: 6px;
            padding: 0.5rem 1.5rem;
            font-weight: 600;
            transition: background 0.3s;
        }
        .brand-btn:hover {
            background: linear-gradient(90deg, var(--brand-blue) 0%, var(--brand-teal) 100%);
        }
        .brand-card {
            background: #fff;
            border-radius: 1rem;
            box-shadow: 0 4px 20px rgba(55,95,122,0.08);
            border: 2px solid rgba(38,186,165,0.13);
        }
        .brand-title {
            color: var(--brand-blue);
            font-weight: 700;
        }
        .brand-subtitle {
            color: var(--brand-teal);
        }
        nav {
            background: linear-gradient(90deg, var(--brand-blue) 0%, var(--brand-teal) 100%);
        }
        nav a {
            color: #fff !important;
        }
        .base-brand-logo { width: 132px; height: 48px; object-fit: contain; padding: 4px 8px; background: #fff; border-radius: 10px; }
        .base-whatsapp { position: fixed; right: 18px; bottom: 18px; z-index: 1000; display: flex; align-items: center; gap: 8px; min-height: 52px; padding: 12px 18px; border: 3px solid #fff; border-radius: 999px; background: var(--brand-teal); color: #fff !important; box-shadow: 0 12px 30px rgba(0,0,0,.2); font-weight: 700; text-decoration: none; }
        @media (max-width: 520px) { .base-whatsapp span { display: none; } .base-whatsapp { width: 56px; height: 56px; justify-content: center; padding: 0; font-size: 24px; } }
    </style>
</head>
<body class="min-h-screen" data-page-name="@yield('title', 'IFE Educabol')">
    <nav class="shadow mb-6">
        <div class="container mx-auto px-4 py-3 flex justify-between items-center">
            <a href="/" aria-label="IFE Educabol, volver al inicio"><img class="base-brand-logo" src="{{ asset('images/logo-ife-educabol-ofical-instituto-de-formacion-educabol.png') }}" alt="IFE Educabol"></a>
        </div>
    </nav>
    <main>
        @yield('content')
    </main>
    <a id="base-whatsapp" class="base-whatsapp" href="#" target="_blank" rel="noopener noreferrer" aria-label="Contactar a IFE Educabol por WhatsApp"><strong>WA</strong><span>¿Te ayudamos?</span></a>
    @stack('scripts')
    <script>
        (function () {
            var link = document.getElementById('base-whatsapp');
            if (!link) return;
            var pageName = document.body.dataset.pageName || document.title;
            var message = 'Hola, vengo de ' + pageName + ' y quisiera más información.';
            link.href = 'https://wa.me/59175553338?text=' + encodeURIComponent(message);
        }());
    </script>
</body>
</html>
