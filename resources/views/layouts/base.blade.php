<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Reserva')</title>
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
    </style>
</head>
<body class="min-h-screen">
    <nav class="shadow mb-6">
        <div class="container mx-auto px-4 py-3 flex justify-between items-center">
            <a href="/" class="text-xl font-bold brand-title">Inicio</a>
        </div>
    </nav>
    <main>
        @yield('content')
    </main>
    @stack('scripts')
</body>
</html>
