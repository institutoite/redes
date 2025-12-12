<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modalidades de {{ $product->nombre }}</title>
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
    <!-- Font Awesome para iconos de WhatsApp y PDF -->
    <!-- Font Awesome desde CDN (CSS) para evitar CORS del kit -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
    <style>
        :root { --brand-teal: rgb(38,186,165); --brand-blue: rgb(55,95,122); }
        :root { --brand-teal: rgb(38,186,165); --brand-blue: rgb(55,95,122); }
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

        /* Chips pequeños seleccionables */
        .chip-group { display: flex; gap: .25rem; flex-wrap: wrap; }
        .chip label { margin: 0; cursor: pointer; }
        .chip input { display: none; }
        .chip span {
            display: inline-block;
            padding: .15rem .45rem;
            font-size: .75rem;
            line-height: 1rem;
            border-radius: 999px;
            border: 1px solid #ced4da;
            background-color: #f8f9fa;
            color: #495057;
        }
        .chip input:checked + span {
            background-color: #18AD0AFF;
            color: #fff;
            border-color: #08910FFF;
        }
        .desc-cell { display: flex; flex-direction: column; min-width: 220px; }
        .desc-text { font-size: .9rem; }
        .desc-actions { margin-top: .5rem; align-self: flex-end; }
        .ventajas-list { font-size: .85rem; margin-top: .35rem; margin-bottom: 0; }
        .ventajas-list .ventaja-item { margin-bottom: .25rem; }
        .ver-mas-btn { font-size: .8rem; }
        /* Contenidos styling */
        .contenidos-table .section-row th {
            background-color: rgba(55,95,122,0.08);
            color: rgb(55,95,122);
            font-weight: 600;
        }
        .contenidos-table .contenido-titulo i { width: 18px; }
        .contenidos-table .badge-subnivel { font-size: .75rem; }
        /* Ocultar meta por defecto en pantallas grandes */
        .mobile-meta { display: none; }
        @media (max-width: 576px) {
            /* Solo la tabla de modalidades se adapta tipo tarjeta y oculta thead */
            .table-modalidades thead { display: none; }
            .table-modalidades tbody tr { display: block; margin-bottom: .75rem; border: 1px solid #dee2e6; border-radius: .5rem; padding: .5rem; }
            /* Oculta columnas Modalidad, Inversión y Acciones en móvil */
            .table-modalidades td[data-label="Modalidad"],
            .table-modalidades td[data-label="Inversión"],
            .table-modalidades td[data-label="Acciones"] { display: none; }
            /* Solo se muestra la columna Descripción y dentro se renderiza todo */
            .table-modalidades td[data-label="Descripción"] { display: block; border: none !important; padding: .25rem .5rem; }
            /* Mostrar meta solo en pantallas pequeñas */
            .mobile-meta { display: flex; flex-wrap: wrap; gap: .25rem; justify-content: space-between; align-items: center; margin-bottom: .25rem; }
            .meta-chip { display: inline-block; font-size: .7rem; padding: .1rem .35rem; border-radius: 999px; background: #f1f3f5; color: #495057; border: 1px solid #dee2e6; }
            .mobile-actions { display: flex; gap: .35rem; justify-content: flex-end; }
            .btn.btn-sm { padding: .25rem .4rem; }
            .desc-text { font-size: .85rem; }
            .ventajas-list { font-size: .8rem; }
        }

        /* Resaltar fila seleccionada de horario */
        .horario-row.selected { background-color: var(--brand-teal) !important; }
        .horario-row.selected td { background-color: transparent; }
        .texto-verde { color: #28a745; background-color: #495057 }
        /* Branding overrides */
        .bg-primary { background-color: var(--brand-blue) !important; }
        .bg-secondary { background-color: var(--brand-teal) !important; }
        .btn-success { background-color: var(--brand-teal); border-color: var(--brand-teal); }
        .btn-info { background-color: var(--brand-blue); border-color: var(--brand-blue); }
        .badge.text-bg-info { background-color: var(--brand-blue) !important; }
        /* Modal styling */
        .modal-header.brand {
            background: var(--brand-blue);
            color: #fff;
        }
        .modal-footer.brand {
            background: rgba(55,95,122,0.06);
        }
        .ventaja-pill { display:inline-block; margin:.15rem .2rem; padding:.2rem .45rem; border-radius:999px; background: rgba(38,186,165,.12); color: var(--brand-blue); border:1px solid rgba(38,186,165,.35); font-size:.85rem; }
        .badge.text-bg-success { background-color: var(--brand-teal) !important; }
        .table thead th { color: #fff; background-color: var(--brand-blue); border-color: var(--brand-blue); }
        .table-striped tbody tr:nth-of-type(odd) { background-color: rgba(55,95,122,.03); }
        .table-hover tbody tr:hover { background-color: rgba(38,186,165,.08); }

    </style>
</head>
<body>
    <div class="container mt-4">
        <div class="rounded-4 p-4 mb-4" style="background: linear-gradient(135deg, rgba(38,186,165,.12), rgba(55,95,122,.12)); border: 1px solid rgba(55,95,122,.15);">
            <div class="d-flex align-items-center gap-3">
                <img src="{{ url('images/logo.png') }}" alt="Logotipo" style="height:54px; width:auto; filter: drop-shadow(0 2px 4px rgba(0,0,0,.15));">
                <div>
                    <h1 class="mb-1" style="color: var(--brand-blue);">{{ $product->nombre }}</h1>
                    <div class="text-muted">Explora horarios, modalidades, contenidos y materiales</div>
                </div>
                <div class="ms-auto">
                    <a href="{{ route('generarpdf',$product) }}" class="btn btn-success">
                        <i class="fa-solid fa-file-pdf me-1"></i> Exportar PDF
                    </a>
                </div>
            </div>
        </div>
        
        
        

        <div class="card mb-4 shadow-sm rounded-4 overflow-hidden" style="border: 1px solid rgba(55,95,122,.15);">
            <div class="card-header bg-secondary text-white d-flex align-items-center" style="border-bottom: none;">
                <i class="fa-solid fa-clock me-2"></i>
                <h4 class="mb-0">Horarios del servicio</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-hover mb-0">
                        <thead>
                            <tr>
                                <th>Horario</th>
                                <th>Estado</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($product->horarios as $horario)
                                <tr class="horario-row" data-horario="{{ $horario->horario }}" data-disponible="{{ $horario->estado ? '1' : '0' }}">
                                    <td>
                                        <div class="d-flex align-items-center gap-2">
                                            <input type="radio" name="horario_{{ $product->id }}" value="{{ $horario->horario }}" @if($horario->estado==0) disabled @endif>
                                            <span @if($horario->estado==0) class="text-danger" @endif>{{ $horario->horario }}</span>
                                        </div>
                                    </td>
                                    <td>
                                        @if ($horario->estado == 0)
                                            <span class="badge bg-danger">Sin cupos</span>
                                        @else
                                            <span class="badge bg-success">Disponible</span>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="2" class="text-muted">Sin horarios para este servicio.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="card mb-4 shadow-sm rounded-4 overflow-hidden" style="border: 1px solid rgba(55,95,122,.15);">
            <div class="card-header bg-primary text-white d-flex align-items-center" style="border-bottom: none;">
                <i class="fa-solid fa-layer-group me-2"></i>
                <h4 class="mb-0">Modalidades</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover align-middle table-modalidades mb-0">
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
                                    <td data-label="Modalidad">
                                        <div class="d-flex align-items-center gap-2">
                                            <span>{{ $modalidad->modalidad }}</span>
                                            
                                        </div>
                                    </td>
                                    <td data-label="Descripción">
                                        <div class="desc-cell">
                                            <!-- Encabezados como chips + valores compactos (solo móvil) -->
                                            <div class="mobile-meta">
                                                <span class="meta-chip">Modalidad</span>
                                                <span class="meta-chip">Inversión</span>
                                            </div>
                                            <div class="mobile-meta">
                                                <span><strong>{{ $modalidad->modalidad }}</strong></span>
                                                <span><strong>Bs {{ number_format($modalidad->inversion, 2) }}</strong> </span>
                                            </div>
                                            <div class="desc-text">{{ $modalidad->descripcion }}</div>

                                            @php
                                                // Reglas de opciones por tipo de modalidad
                                                $nombre = mb_strtolower($modalidad->modalidad);
                                                $isTresVeces = str_contains($nombre, 'tres') || str_contains($nombre, '3');
                                                $isLunesAViernes = str_contains($nombre, 'lunes a viernes') || str_contains($nombre, 'lav');
                                                $options = [];
                                                if ($isTresVeces) {
                                                    $options = ['LMV','MJS','SABADOS'];
                                                } elseif ($isLunesAViernes) {
                                                    $options = ['Lunes a Viernes'];
                                                } else {
                                                    // Fallback: construir desde días relacionados
                                                    $diasKeys = $modalidad->dias->pluck('dia')->map(function($d){
                                                        $d = mb_strtolower($d);
                                                        $d = str_replace(['á','é','í','ó','ú'], ['a','e','i','o','u'], $d);
                                                        return $d;
                                                    })->toArray();
                                                    $setLMV = ['lunes','miercoles','viernes'];
                                                    $setMJS = ['martes','jueves','sabado'];
                                                    $setLAV = ['lunes','martes','miercoles','jueves','viernes'];
                                                    if (count(array_intersect($setLMV, $diasKeys)) === count($setLMV)) $options[] = 'LMV';
                                                    if (count(array_intersect($setMJS, $diasKeys)) === count($setMJS)) $options[] = 'MJS';
                                                    if (count(array_intersect($setLAV, $diasKeys)) === count($setLAV)) $options[] = 'Lunes a Viernes';
                                                }
                                            @endphp

                                            <div class="desc-actions chip-group">
                                                @if (count($options))
                                                    @foreach ($options as $opt)
                                                        <div class="chip">
                                                            <label>
                                                                <input type="radio" name="opcion_{{ $modalidad->id }}" value="{{ $opt }}">
                                                                <span>{{ $opt }}</span>
                                                            </label>
                                                        </div>
                                                    @endforeach
                                                @else
                                                    @foreach ($modalidad->dias as $dia)
                                                        <div class="chip">
                                                            <label>
                                                                <input type="radio" name="opcion_{{ $modalidad->id }}" value="{{ $dia->dia }}">
                                                                <span>{{ $dia->dia }}</span>
                                                            </label>
                                                        </div>
                                                    @endforeach
                                                @endif
                                            </div>

                                            
                                        </div>
                                    </td>
                                    <td data-label="Inversión">{{ number_format($modalidad->inversion, 2) }}</td>
                                    <td data-label="Acciones" class="d-flex gap-2 align-items-center">
                                        <a href="#" class="btn btn-success btn-sm" title="Quiero este servicio"
                                           data-id="{{ $modalidad->id }}"
                                           data-mod="{{ e($modalidad->modalidad) }}"
                                           data-inv="{{ e(number_format($modalidad->inversion, 2)) }}"
                                           onclick="whatsappModalidadFromEl(this)">
                                            <i class="fab fa-whatsapp"></i>
                                        </a>
                                        <a href="{{ route('generarmodalidadpdf', $modalidad) }}" class="btn btn-info btn-sm" title="Convertir a PDF">
                                            <i class="fa-solid fa-file-pdf"></i>
                                        </a>
                                        <button type="button"
                                                class="btn btn-outline-primary btn-sm btn-ver-ventajas"
                                                title="Ver ventajas"
                                                data-mod-nombre="{{ e($modalidad->modalidad) }}"
                                                data-ventajas='@json($modalidad->ventajas->map(fn($v)=>["ventaja"=>$v->ventaja,"detalle"=>$v->detalle]))'>
                                            <i class="fa-solid fa-list-check"></i>
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Modal: Ventajas por Modalidad -->
        <div class="modal fade" id="ventajasModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header brand">
                        <h5 class="modal-title" id="ventajasModalLabel">Ventajas</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div id="ventajasLista" class="mb-2"></div>
                        <hr/>
                        <div id="recomendacionTexto" style="font-weight:600;"></div>
                    </div>
                    <div class="modal-footer brand">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="card mb-4">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">Ventajas ({{ $product->nombre }})</h4>
                </div>
            <div class="card-body">
                @php
                    $ventajas = collect($product->modalidades)
                        ->flatMap(fn($m) => $m->ventajas)
                        ->unique('ventaja')
                        ->values();
                    $maxShow = 5; $total = $ventajas->count();
                @endphp
                @if($total)
                    <ul class="ventajas-list list-unstyled">
                        @foreach ($ventajas as $index => $v)
                            <li class="ventaja-item {{ $index >= $maxShow ? 'd-none extra-ventaja-general' : '' }}">
                                <i class="fa-solid fa-circle-check text-success me-1"></i>
                                <strong>{{ $v->ventaja }}:</strong>
                                <span class="text-muted">{{ $v->detalle }}</span>
                            </li>
                        @endforeach
                    </ul>
                    @if ($total > $maxShow)
                        <button type="button" class="btn btn-link p-0 ver-mas-btn" data-target="general">Ver más</button>
                    @endif
                @else
                    <div class="text-muted">Sin ventajas registradas.</div>
                @endif
            </div>
        </div>

        <div class="card mb-4 shadow-sm rounded-4 overflow-hidden" style="border: 1px solid rgba(55,95,122,.15);">
            <div class="card-header bg-primary text-white d-flex align-items-center" style="border-bottom: none;">
                <i class="fa-solid fa-book-open me-2"></i>
                <h4 class="mb-0">Contenidos {{ $product->nombre }}</h4>
            </div>
            <div class="card-body">
                @php
                    $contenidos = $product->contenidos()
                        ->where('estado', true)
                        ->orderBy('subnivel')
                        ->orderBy('orden')
                        ->get()
                        ->groupBy(fn($i) => $i->subnivel ?? 'General');
                @endphp
                @if($contenidos->count())
                    <div class="accordion" id="accordionContenidos">
                        @foreach($contenidos as $subnivel => $items)
                            @php $subId = 'subnivel_'.md5($subnivel); @endphp
                            <div class="accordion-item" style="border:1px solid rgba(55,95,122,.15); border-radius: .75rem; overflow:hidden; margin-bottom:.5rem;">
                                <h2 class="accordion-header" id="heading_{{ $subId }}">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse_{{ $subId }}" aria-expanded="false" aria-controls="collapse_{{ $subId }}">
                                        <span class="badge badge-subnivel rounded-pill text-bg-info me-2">{{ $subnivel }}</span>
                                        <span style="color: var(--brand-blue);">{{ $product->nombre }} — {{ $subnivel }}</span>
                                    </button>
                                </h2>
                                <div id="collapse_{{ $subId }}" class="accordion-collapse collapse" aria-labelledby="heading_{{ $subId }}" data-bs-parent="#accordionContenidos">
                                    <div class="accordion-body p-0">
                                        <div class="table-responsive">
                                            <table class="table table-hover contenidos-table mb-0">
                                                <thead>
                                                    <tr>
                                                        <th style="width: 320px;">Contenido</th>
                                                        <th>Descripción</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($items as $c)
                                                        <tr>
                                                            <td class="contenido-titulo">
                                                                <i class="fa-solid fa-circle-chevron-right text-info me-2"></i>
                                                                {{ $c->titulo }}
                                                            </td>
                                                            <td class="text-muted">{{ $c->descripcion }}</td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="text-muted">Sin contenidos registrados para este nivel.</div>
                @endif
            </div>
        </div>

        <div class="card mb-4 shadow-sm rounded-4 overflow-hidden" style="border: 1px solid rgba(55,95,122,.15);">
            <div class="card-header bg-primary text-white d-flex align-items-center" style="border-bottom: none;">
                <i class="fa-solid fa-toolbox me-2"></i>
                <h4 class="mb-0">Materiales {{ $product->nombre }} </h4>
            </div>
            <div class="card-body">
                @php $materiales = $product->materiales()->where('estado', true)->orderBy('orden')->get(); @endphp
                @if($materiales->count())
                    <ul class="mb-0 list-unstyled d-flex flex-wrap gap-2">
                        @foreach($materiales as $mat)
                            <li class="ventaja-pill" style="background: rgba(55,95,122,.06); border-color: rgba(55,95,122,.25); color: var(--brand-blue);">
                                <i class="fa-solid fa-check me-1" style="color: var(--brand-teal);"></i>
                                <strong>{{ $mat->nombre }}</strong>
                                @if($mat->descripcion)
                                    <span class="text-muted">— {{ $mat->descripcion }}</span>
                                @endif
                            </li>
                        @endforeach
                    </ul>
                @else
                    <div class="text-muted">Sin materiales registrados para este nivel.</div>
                @endif
            </div>
        </div>

    </div>


    <script>
        function whatsappModalidad(modalidadId, modalidad, inversion) {
            const phoneNumber = "{{$info->code ?? ''}}{{$info->phone ?? ''}}"; // Usa datos de $info si están disponibles
            const selected = document.querySelector(`input[name="opcion_${modalidadId}"]:checked`);
            const opcion = selected ? selected.value : null;
            const opcionLinea = opcion ? `\nOpción: *${opcion}*` : '';
            const selHorario = document.querySelector(`input[name="horario_{{ $product->id }}"]:checked`);
            const horario = selHorario ? selHorario.value : null;
            const horarioLinea = horario ? `\nHorario: *${horario}*` : '';
            const message = `Hola, quiero este servicio: *${modalidad}*\nNivel: *{{$product->nombre}}*\nInversión: *Bs ${inversion}*${opcionLinea}${horarioLinea}`;
            console.log("Mensaje WhatsApp:", phoneNumber);
            const url = `https://wa.me/${phoneNumber}?text=${encodeURIComponent(message)}`;
            window.open(url, '_blank');
        }
        // Seleccionar horario por clic y resaltar la fila (marcar radio)
        document.addEventListener('DOMContentLoaded', function(){
            document.querySelectorAll('.horario-row').forEach(function(row){
                row.addEventListener('click', function(){
                    const disponible = row.getAttribute('data-disponible') === '1';
                    if (!disponible) return;
                    document.querySelectorAll('.horario-row.selected').forEach(function(r){ r.classList.remove('selected'); });
                    row.classList.add('selected');
                    const radio = row.querySelector('input[type="radio"]');
                    if (radio) radio.checked = true;
                });
            });
        });
        function whatsappModalidadFromEl(el) {
            var id = el.getAttribute('data-id');
            var mod = el.getAttribute('data-mod');
            var inv = el.getAttribute('data-inv');
            whatsappModalidad(id, mod, inv);
        }

        // Recomendación según modalidad
        function construirRecomendacion(nombre) {
            const n = (nombre || '').toLowerCase();
            if (n.includes('hora libre')) return 'Ideal para una duda concreta, ejercicio específico o aclaración puntual. Si necesitas más refuerzo, considera Semana o Quincena.';
            if (n.includes('semana') && n.includes('3')) return 'Buena para preparar exámenes o exposiciones si tu avance es regular. Si estás rezagado, prefiere Lunes a Viernes.';
            if (n.includes('semana') && n.includes('lunes a viernes')) return 'Recomendado si estás con urgencia o en riesgo de reprobar. Refuerzo diario según materias y temas pendientes.';
            if (n.includes('quincena') && n.includes('3')) return 'Permite abordar prácticos y exposiciones más largas. Si necesitas mayor recuperación, elige Lunes a Viernes.';
            if (n.includes('quincena') && n.includes('lunes a viernes')) return 'Refuerzo sostenido para varias áreas a la vez. Útil si el avance está rezagado.';
            if (n.includes('mes') && n.includes('3') && !n.includes('2 meses') && !n.includes('3 meses')) return 'Tiempo suficiente para nivelar hasta dos materias si tu avance es regular.';
            if (n.includes('mes') && n.includes('lunes a viernes') && !n.includes('2 meses') && !n.includes('3 meses')) return 'Nivelación intensiva para consolidar contenidos con mayor rapidez.';
            if (n.includes('2 meses') && n.includes('3')) return 'Plan para trabajar hasta tres materias con profundidad y progreso sostenido.';
            if (n.includes('2 meses') && n.includes('lunes a viernes')) return 'Recuperación de varias materias si estás por reprobar; mayor carga horaria para resultados visibles.';
            if (n.includes('3 meses') && n.includes('3')) return 'Acompañamiento continuo tipo trimestral, construyendo base sólida y preparando evaluaciones.';
            if (n.includes('3 meses') && n.includes('lunes a viernes')) return 'Mejor opción para casos críticos: cobertura completa diaria si peligra el año.';
            return 'A mayor urgencia y cantidad de temas, recomienda modalidades con más carga horaria (L-V).';
        }

        // Abrir modal con ventajas
        document.addEventListener('DOMContentLoaded', function(){
            const modalEl = document.getElementById('ventajasModal');
            const ventajasLista = document.getElementById('ventajasLista');
            const recomendacionTexto = document.getElementById('recomendacionTexto');
            document.querySelectorAll('.btn-ver-ventajas').forEach(function(btn){
                btn.addEventListener('click', function(){
                    const nombre = btn.getAttribute('data-mod-nombre');
                    const ventajasJson = btn.getAttribute('data-ventajas');
                    let ventajas = [];
                    try { ventajas = JSON.parse(ventajasJson || '[]'); } catch(e) {}
                    document.getElementById('ventajasModalLabel').textContent = `Ventajas — ${nombre}`;
                    ventajasLista.innerHTML = ventajas.length
                        ? ventajas.map(v=>`<span class="ventaja-pill"><strong>${v.ventaja}</strong>: ${v.detalle}</span>`).join('')
                        : '<div class="text-muted">Sin ventajas registradas.</div>';
                    recomendacionTexto.textContent = construirRecomendacion(nombre);
                    const bsModal = new bootstrap.Modal(modalEl);
                    bsModal.show();
                });
            });
        });

        // Toggle "Ver más" de ventajas por modalidad
        document.addEventListener('click', function(e){
            if (e.target && e.target.matches('.ver-mas-btn')) {
                var targetId = e.target.getAttribute('data-target');
                var selector = (targetId === 'general') ? '.extra-ventaja-general' : ('.extra-ventaja-' + targetId);
                var hiddenItems = document.querySelectorAll(selector);
                var isHidden = hiddenItems.length && hiddenItems[0].classList.contains('d-none');
                hiddenItems.forEach(function(el){ el.classList.toggle('d-none'); });
                e.target.textContent = isHidden ? 'Ver menos' : 'Ver más';
            }
        });

        
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