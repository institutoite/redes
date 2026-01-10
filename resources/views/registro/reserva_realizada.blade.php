@extends('layouts.base')

@section('content')
<style>
  :root {
    --primary: rgb(38,186,165);
    --secondary: rgb(55,95,122);

    --primary-soft: rgba(38,186,165,.12);
    --primary-ring: rgba(38,186,165,.28);

    --secondary-soft: rgba(55,95,122,.06);
    --border: rgba(55,95,122,.18);
    --muted: rgba(55,95,122,.78);

    --text: rgb(15,23,42);
    --shadow: 0 16px 42px rgba(0,0,0,.08);
  }

  /* Anti-desborde global (OBLIGATORIO) */
  *,*::before,*::after{ box-sizing:border-box; }
  html,body{ width:100%; overflow-x:hidden; }
  img,embed,svg{ max-width:100%; height:auto; }

  /* Por si el layout base mete contenedores raros */
  .rv-wrap, .rv-card, .rv-body, .rv-panel, .rv-panel__body { max-width: 100%; }

  .rv-wrap{
    padding: 48px 16px;
    display:flex;
    justify-content:center;
  }

  .rv-card{
    width:100%;
    max-width: 760px;
    background:#fff;
    border: 1px solid var(--border);
    border-radius: 22px;
    overflow:hidden; /* evita fugas visuales */
    box-shadow: var(--shadow);
  }

  /* Header */
  .rv-header{
    padding: 28px 28px 22px;
    border-bottom: 1px solid var(--border);
    text-align:center;
  }

  .rv-icon{
    width:56px;height:56px;
    margin: 0 auto 12px;
    border-radius:999px;
    display:grid; place-items:center;
    background: var(--primary-soft);
    color: var(--primary);
    font-weight:900;
    font-size: 28px;
    line-height:1;
  }

  .rv-title{
    margin:0;
    font-size: 22px;
    font-weight: 900;
    color: var(--secondary);
    letter-spacing:.2px;
  }

  .rv-subtitle{
    margin: 8px auto 0;
    max-width: 56ch;
    font-size: 14px;
    line-height: 1.45;
    color: var(--muted);
  }

  /* Body */
  .rv-body{
    padding: 28px;
    display:grid;
    gap: 18px;
    min-width: 0; /* clave anti-overflow en grids */
  }

  .rv-panel{
    border: 1px solid var(--border);
    border-radius: 18px;
    overflow:hidden;
    min-width: 0; /* clave */
  }

  /* Header del panel: aquí nacía el overflow */
  .rv-panel__head{
    padding: 14px 16px;
    background: var(--secondary-soft);
    border-bottom: 1px solid rgba(55,95,122,.12);

    display:flex;
    align-items:center;
    justify-content:space-between;
    gap: 10px;

    flex-wrap: wrap; /* ✅ en móvil baja la badge */
    min-width: 0;    /* ✅ permite encoger */
  }

  .rv-panel__title{
    margin:0;
    font-size: 14px;
    font-weight: 900;
    color: var(--secondary);
    min-width: 0; /* ✅ */
  }

  .rv-badge{
    display:inline-flex;
    align-items:center;
    gap: 8px;
    padding: 6px 10px;
    border-radius: 999px;
    font-size: 12px;
    font-weight: 800;
    color: var(--secondary);
    border: 1px solid rgba(38,186,165,.25);
    background: rgba(38,186,165,.10);

    max-width: 100%;
    white-space: normal;     /* ✅ NO fuerces una línea */
    overflow-wrap: anywhere; /* ✅ si es largo, corta */
  }

  .rv-panel__body{
    padding: 16px;
    background:#fff;
    min-width: 0;
  }

  /* Datos: layout pro + anti overflow */
  .rv-grid{
    display:grid;
    grid-template-columns: 1fr 1fr;
    gap: 12px;
    min-width: 0;
  }

  .rv-item{
    border: 1px solid rgba(55,95,122,.12);
    border-radius: 14px;
    padding: 12px;
    background: #fff;
    min-width: 0; /* ✅ */
  }

  .rv-label{
    display:block;
    font-size: 12px;
    font-weight: 900;
    color: var(--secondary);
    margin-bottom: 4px;
  }

  .rv-value{
    font-size: 14px;
    color: var(--text);
    line-height: 1.35;

    /* ✅ corta cualquier texto que quiera romper la pantalla */
    overflow-wrap: anywhere;
    word-break: break-word;
    min-width: 0;
  }

  .rv-item--full{ grid-column: 1 / -1; }

  /* Acciones */
  .rv-actions{
    display:flex;
    flex-wrap: wrap;         /* ✅ si no entra, baja */
    gap: 12px;
    justify-content: flex-end;
    padding: 18px 28px;
    border-top: 1px solid var(--border);
    background: #fff;
    min-width: 0;
  }

  .btn{
    display:inline-flex;
    align-items:center;
    justify-content:center;
    gap: 10px;
    padding: 12px 18px;
    border-radius: 14px;
    font-size: 14px;
    font-weight: 900;
    cursor:pointer;
    text-decoration:none;
    user-select:none;
    border: 1px solid transparent;
    transition: transform .06s ease, filter .12s ease, box-shadow .12s ease;
    max-width: 100%;
    min-width: 0;
  }
  .btn:active{ transform: translateY(1px); }
  .btn:focus{ outline:none; box-shadow: 0 0 0 3px var(--primary-ring); }

  .btn-secondary{
    background: var(--secondary);
    color:#fff;
  }
  .btn-secondary:hover{ filter: brightness(.96); }

  .btn-ghost{
    background: #fff;
    color: var(--secondary);
    border-color: rgba(55,95,122,.22);
  }
  .btn-ghost:hover{ background: rgba(55,95,122,.06); }

  /* Responsive */
  @media (max-width: 640px){
    .rv-wrap{ padding: 34px 14px; }
    .rv-header{ padding: 22px 18px 18px; }
    .rv-body{ padding: 18px; }

    .rv-grid{ grid-template-columns: 1fr; }

    .rv-actions{
      padding: 16px 18px;
      justify-content: stretch;
    }
    .rv-actions .btn{ width: 100%; }
  }
</style>

<div class="rv-wrap">
  <div class="rv-card">

    <header class="rv-header">
      <div class="rv-icon" aria-hidden="true">✓</div>
      <h2 class="rv-title">¡Reserva realizada!</h2>
      <p class="rv-subtitle">
        Tu comprobante fue recibido correctamente. En momentos verificaremos el pago y te daremos de alta.
        Te avisaremos por WhatsApp o teléfono.
      </p>
    </header>

    <main class="rv-body">
      <section class="rv-panel" aria-labelledby="datos-title">
        <div class="rv-panel__head">
          <h3 id="datos-title" class="rv-panel__title">Detalle de la reserva</h3>
          <span class="rv-badge">Estado: en verificación</span>
        </div>

        <div class="rv-panel__body">
          <div class="rv-grid">
            <div class="rv-item">
              <span class="rv-label">Estudiante</span>
              <div class="rv-value">{{ $registro->nombre_estudiante ?? '' }}</div>
            </div>

            <div class="rv-item">
              <span class="rv-label">Fecha de nacimiento</span>
              <div class="rv-value">
                {{ isset($registro->fecha_nacimiento) ? $registro->fecha_nacimiento->format('d/m/Y') : '' }}
              </div>
            </div>

            <div class="rv-item rv-item--full">
              <span class="rv-label">Requerimiento</span>
              <div class="rv-value">{!! $registro->requerimiento ?? '' !!}</div>
            </div>

            <div class="rv-item">
              <span class="rv-label">Apoderado</span>
              <div class="rv-value">{{ $registro->nombre_apoderado ?? '' }}</div>
            </div>

            <div class="rv-item">
              <span class="rv-label">Teléfono apoderado</span>
              <div class="rv-value">{{ $registro->telefono_apoderado ?? '' }}</div>
            </div>
          </div>
        </div>
      </section>
    </main>

    <footer class="rv-actions">
      @if(isset($registro) && !empty($registro->id))
        <a href="{{ route('registro.pdf', $registro->id) }}" class="btn btn-secondary" target="_blank" rel="noopener">
          Descargar PDF
        </a>
      @endif
      <a href="/" class="btn btn-ghost">Volver al inicio</a>
    </footer>

  </div>
</div>
@endsection
