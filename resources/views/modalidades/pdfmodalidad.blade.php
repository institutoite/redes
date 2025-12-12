<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reporte de Modalidades</title>
    <style>
       /* Glypha LT Std Bold */
        @font-face {
            font-family: 'Glypha LT Std';
            src: url('/fonts/GlyphaLTStd-Bold.otf') format('opentype');
            font-weight: bold;
            font-style: normal;
        }

        /* Montserrat Black */
        @font-face {
            font-family: 'Montserrat';
            src: url('/fonts/Montserrat-Black.otf') format('opentype');
            font-weight: 900; /* Peso de fuente para 'Black' */
            font-style: normal;
        }

        /* Montserrat Black Italic */
        @font-face {
            font-family: 'Montserrat';
            src: url('/fonts/Montserrat-BlackItalic.ttf') format('truetype');
            font-weight: 900; /* Peso de fuente para 'Black' */
            font-style: italic;
        }

        /* Montserrat Bold */
        @font-face {
            font-family: 'Montserrat';
            src: url('/fonts/Montserrat-Bold.otf') format('opentype');
            font-weight: bold;
            font-style: normal;
        }

        /* Montserrat Bold Italic */
        @font-face {
            font-family: 'Montserrat';
            src: url('/fonts/Montserrat-BoldItalic.ttf') format('truetype');
            font-weight: bold;
            font-style: italic;
        }


        body {
            font-family: 'Glypha LT Std',Arial, sans-serif;
            margin: 0;
            padding: 0;
            position: relative;
        }
        header {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            width: 100%;
            background: white;
            padding: 12px 0 8px;
            text-align: center;
            z-index: 10;
            border-bottom: 2px solid rgb(55,95,122);
        }
        .header-height { height: 120px; }
        .container {
            padding: 20px;
            margin: 0 auto;
            position: relative;
            z-index: 1;
        }
        header img {
            max-width: 120px;
            float: right; /* Alinea la imagen a la derecha */
            margin-right: 20px; /* Agrega espacio entre la imagen y el borde derecho */
        }

        h1{
            font-family: 'Glypha LT Std', Arial, sans-serif;
        }

        header h1 {
            margin: 10px 0 5px;
            font-size: 24px;
        }
        .background-logo {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: 1; /* Imagen detrás de todo */
        }
        .modalidad {
            page-break-after: always;
        }
        .modalidad h2 {
            color: rgb(55,95,122);
            margin-bottom: 10px;
        }
        .card {
            /*border: 1px solid #ddd;*/
            margin-bottom: 20px;
            padding: 15px;
            border-radius: 5px;
        }
        .card h5 {
            margin-bottom: 10px;
            color: #110d0d;
        }
        .card p, .card ul {
            margin: 5px 0;
            color: #aaa;
        }
        .card-footer {
            text-align: center;
            font-size: 12px;
            margin-top: 20px;
            color: #aaa;
        }
    </style>
</head>
<body>
    <!-- Imagen de fondo -->
    @php
        $logoJpg = public_path('images/logo.jpg');
        $logoPng = public_path('images/logo.png');
        $bgStyle = '';
        if (file_exists($logoJpg)) {
            $bgStyle = "background: url('file://$logoJpg') no-repeat center; background-size: contain; opacity: 0.1;";
        } elseif (file_exists($logoPng)) {
            // Nota: PNG con transparencia puede causar problemas; idealmente usar JPG.
            $bgStyle = "background: url('file://$logoPng') no-repeat center; background-size: contain; opacity: 0.1;";
        }
    @endphp
    <div class="background-logo" @if($bgStyle) style="{{ $bgStyle }}" @endif></div>

    <!-- Encabezado -->
    <header>
        @php
            $logoHeader = null;
            if (file_exists($logoJpg)) { $logoHeader = $logoJpg; }
            elseif (file_exists($logoPng)) { $logoHeader = $logoPng; }
        @endphp
        @if($logoHeader)
            <img src="file://{{ $logoHeader }}" alt="Logotipo">
        @endif
        <div style="text-align:left; margin-left:20px; color: rgb(55,95,122);">
            <div style="font-size:18px; font-weight:bold;">Instituto ITE</div>
            @if(isset($location))
                <div style="font-size:12px;">{{ $location->address ?? '' }} — {{ $location->city ?? '' }}</div>
            @endif
            @if(isset($info))
                <div style="font-size:12px;">WhatsApp: +{{ $info->code }} {{ $info->phone }} · Web: {{ $info->web ?? 'www.institutoite.bo' }}</div>
                <div style="font-size:12px;">Email: {{ $info->email ?? '' }}</div>
            @endif
            
            @if(isset($socials) && $socials->count())
                <div style="font-size:12px; display:flex; align-items:center; gap:8px; flex-wrap:wrap;">
                    <span>Redes:</span>
                    @foreach($socials as $s)
                        @php
                            $url = $s->link ?? '';
                            if (!$url) continue;
                            $n = strtolower($url);
                            $path = parse_url($url, PHP_URL_PATH);
                            $short = $path ? basename(rtrim($path, '/')) : $url;
                        @endphp
                        <a href="{{ $url }}" style="display:inline-flex; align-items:center; gap:4px; color: rgb(55,95,122); text-decoration: none;">
                            @if(str_contains($n,'facebook'))
                                <span style="display:inline-block; width:14px; height:14px;">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512" width="14" height="14" fill="rgb(55,95,122)"><path d="M279.14 288l14.22-92.66h-88.91v-60.13c0-25.35 12.42-50.06 52.24-50.06h40.42V6.26S263.71 0 225.36 0c-73.22 0-121.05 44.38-121.05 124.72v70.62H22.89V288h81.42v224h100.17V288z"/></svg>
                                </span>
                            @elseif(str_contains($n,'instagram'))
                                <span style="display:inline-block; width:14px; height:14px;">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" width="14" height="14" fill="rgb(55,95,122)"><path d="M224,202.66A53.34,53.34,0,1,0,277.34,256,53.38,53.38,0,0,0,224,202.66ZM398.8,80A48,48,0,1,0,446.8,128,48,48,0,0,0,398.8,80ZM224,338.67A82.67,82.67,0,1,1,306.67,256,82.76,82.76,0,0,1,224,338.67ZM398.8,0H49.2A49.2,49.2,0,0,0,0,49.2V462.8A49.2,49.2,0,0,0,49.2,512H398.8A49.2,49.2,0,0,0,448,462.8V49.2A49.2,49.2,0,0,0,398.8,0ZM400,462.8a1.2,1.2,0,0,1-1.2,1.2H49.2a1.2,1.2,0,0,1-1.2-1.2V49.2A1.2,1.2,0,0,1,49.2,48H398.8a1.2,1.2,0,0,1,1.2,1.2Z"/></svg>
                                </span>
                            @elseif(str_contains($n,'twitter') || str_contains($n,'x'))
                                <span style="display:inline-block; width:14px; height:14px;">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" width="14" height="14" fill="rgb(55,95,122)"><path d="M459.37 151.716c.325 4.548.325 9.097.325 13.645 0 138.72-105.583 298.558-298.558 298.558-59.452 0-114.68-17.219-161.137-47.106 8.447.974 16.568 1.299 25.34 1.299 49.055 0 94.213-16.568 130.274-44.832-46.132-.975-84.792-31.188-98.112-72.772 6.498.974 12.995 1.624 19.818 1.624 9.421 0 18.843-1.299 27.614-3.573-48.081-9.747-84.143-51.98-84.143-103.001v-1.299c14.182 7.896 30.355 12.67 47.431 13.319-28.264-18.843-46.781-51.005-46.781-87.391 0-19.492 5.197-37.36 14.507-52.954 52.954 65.3 132.196 108.029 221.071 112.807-1.624-7.896-2.599-15.793-2.599-23.69 0-57.828 46.782-104.934 104.934-104.934 30.355 0 57.502 12.67 76.67 33.137 24.012-4.548 46.456-13.32 66.599-25.34-7.896 24.665-24.665 45.349-46.456 58.5 21.366-2.273 41.833-8.122 60.747-16.243-14.182 20.791-32.161 39.308-52.628 54.253z"/></svg>
                                </span>
                            @elseif(str_contains($n,'youtube'))
                                <span style="display:inline-block; width:14px; height:14px;">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" width="14" height="14" fill="rgb(55,95,122)"><path d="M549.655 124.083c-6.281-23.62-24.8-42.242-48.093-48.543C458.44 64 288 64 288 64s-170.44 0-213.562 11.54c-23.293 6.3 41.812 24.923 48.093 48.543C16 167.36 16 256 16 256s0 88.64 10.345 131.917c6.281 23.62 24.8 42.242 48.093 48.543C117.56 448 288 448 288 448s170.44 0 213.562-11.54c23.293-6.3 41.812-24.923 48.093-48.543C560 344.64 560 256 560 256s0-88.64-10.345-131.917zM232 334.857V177.143L382 256 232 334.857z"/></svg>
                                </span>
                            @endif
                            <span>{{ ucfirst($s->social) }}: {{ $short }}</span>
                        </a>
                    @endforeach
                </div>
            @endif
        </div>
    </header>
    <div class="header-height"></div>
   
    <!-- Contenido principal -->
    <div class="container">
        
        <div class="modalidad">
            <h2>{{ $modalidad->modalidad }}</h2>
            <div class="card">
                <h5>Inversión:</h5>
                <p>Bs {{ number_format($modalidad->inversion, 2) }}</p>
                <h5>Descripción:</h5>
                <p>{{ $modalidad->descripcion }}</p>
                <h5>Horarios disponibles:</h5>
                <ul>
                    @foreach ($modalidad->horarios as $horario)
                        <li>
                            @if ($horario->estado == 0)
                                <span style="text-decoration: line-through; color: rgb(67, 67, 67);">
                                    {{ $horario->horario }} - <span class="text-danger">(SIN CUPO)</span>
                                </span>
                            @else
                                {{ $horario->horario }}
                            @endif
                        </li>
                    @endforeach
                </ul>
                <h5>Días de asistencia:</h5>
                <ul>
                    @foreach ($modalidad->dias as $dia)
                        <li>{{ $dia->dia }}</li>
                    @endforeach
                </ul>
                <h5>Beneficios (generales):</h5>
                <ul style="list-style: none; padding-left: 0;">
                    @php
                        $ventajas = collect($modalidad->product->modalidades)->flatMap(fn($m)=>$m->ventajas)->unique('ventaja');
                    @endphp
                    @foreach ($ventajas as $ventaja)
                        <li>{{ $ventaja->ventaja }}: {{ $ventaja->detalle }}</li>
                    @endforeach
                </ul>

                <h5>Materiales sugeridos:</h5>
                <ul style="list-style: none; padding-left: 0;">
                    @foreach ($modalidad->product->materiales as $mat)
                        <li>{{ $mat->nombre }}@if($mat->descripcion): {{ $mat->descripcion }}@endif</li>
                    @endforeach
                </ul>

                <h5>Contenidos (Nivel Inicial):</h5>
                <ul style="list-style: none; padding-left: 0;">
                    @foreach ($modalidad->product->contenidos as $c)
                        <li>{{ $c->subnivel ?? 'General' }} — {{ $c->titulo }}: {{ $c->descripcion }}</li>
                    @endforeach
                </ul>
                <div style="position: fixed; bottom: 10px; left: 20px; right: 20px; font-size: 11px; color: rgb(55,95,122); border-top: 1px solid rgba(55,95,122,0.4); padding-top: 6px;">
                    @if(isset($info))
                        WhatsApp: +{{ $info->code }} {{ $info->phone }} · Web: {{ $info->web ?? 'www.institutoite.bo' }} · Email: {{ $info->email ?? '' }}
                    @endif
                    @if(isset($socials) && $socials->count())
                        · Redes:
                        @foreach($socials as $s)
                            @php
                                $url = $s->link ?? '';
                                if (!$url) continue;
                                $path = parse_url($url, PHP_URL_PATH);
                                $short = $path ? basename(rtrim($path, '/')) : $url;
                            @endphp
                            <a href="{{ $url }}" style="color: rgb(55,95,122); text-decoration: none;">{{ ucfirst($s->social) }}: {{ $short }}</a>@if(!$loop->last) · @endif
                        @endforeach
                    @endif
                    @if(isset($location))
                        · {{ $location->address ?? '' }} — {{ $location->city ?? '' }}
                    @endif
                </div>
            </div>
        </div>
    </div>
</body>
</html>
