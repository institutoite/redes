@extends('layouts.base')

@section('content')
<style>
 /* =========================
   REGISTRO EXITOSO (ITE)
   Primario:   rgb(38,186,165)
   Secundario: rgb(55,95,122)
   ========================= */

:root {
  --primary: rgb(38,186,165);
  --secondary: rgb(55,95,122);

  --primary-soft: rgba(38,186,165, 0.12);
  --primary-ring: rgba(38,186,165, 0.28);

  --secondary-soft: rgba(55,95,122, 0.06);
  --border: rgba(55,95,122, 0.18);
  --muted: rgba(55,95,122, 0.78);

  --text: rgb(15, 23, 42);
  --shadow: 0 16px 42px rgba(0, 0, 0, 0.08);
}

/* Anti-desborde (OBLIGATORIO en móvil) */
*,
*::before,
*::after {
  box-sizing: border-box;
}

html,
body {
  width: 100%;
  overflow-x: hidden;
}

img,
embed,
video,
canvas,
svg {
  max-width: 100%;
}

/* Layout */
.re-wrap {
  padding: 48px 16px;
  display: flex;
  justify-content: center;
}

.re-card {
  width: 100%;
  max-width: 760px;
  background: #fff;
  border: 1px solid var(--border);
  border-radius: 22px;
  overflow: hidden;
  box-shadow: var(--shadow);
}

/* Header */
.re-header {
  padding: 28px 28px 24px;
  text-align: center;
  border-bottom: 1px solid var(--border);
}

.re-icon {
  width: 56px;
  height: 56px;
  margin: 0 auto 12px;
  border-radius: 999px;
  display: grid;
  place-items: center;
  background: var(--primary-soft);
  color: var(--primary);
  font-weight: 800;
  font-size: 28px;
  line-height: 1;
}

.re-title {
  margin: 0;
  font-size: 22px;
  font-weight: 800;
  color: var(--secondary);
  letter-spacing: 0.2px;
}

.re-subtitle {
  margin-top: 6px;
  font-size: 14px;
  color: var(--muted);
  line-height: 1.4;
}

.re-subtitle strong {
  color: var(--text);
}

/* Body */
.re-body {
  padding: 32px;
  display: grid;
  gap: 28px;
}

.re-h2 {
  margin: 0;
  font-size: 14px;
  font-weight: 800;
  color: var(--secondary);
}

.re-p {
  margin: 6px 0 14px;
  font-size: 13px;
  color: var(--muted);
}

/* QR Section (protagonista, sin overflow) */
.re-qr-section {
  background: var(--secondary-soft);
  border: 1px solid rgba(55, 95, 122, 0.10);
  border-radius: 20px;
  padding: 32px;
  text-align: center;
}

/* IMPORTANTE: el contenedor del QR debe ser 100% y con max-width */
.re-qr-box {
  width: 100%;
  max-width: 360px; /* límite agradable en desktop */
  margin: 18px auto 14px;
  padding: 14px;
  background: #fff;
  border: 1px solid rgba(55, 95, 122, 0.12);
  border-radius: 20px;
}

/* IMPORTANTE: el QR se adapta al contenedor */
.re-qr-img {
  display: block;
  width: 100%;
  height: auto;
  aspect-ratio: 1 / 1;
  object-fit: contain;
  border-radius: 14px;
}

/* Preview */
.re-preview {
  min-height: 6px;
}

.re-preview img {
  display: block;
  margin: 10px auto 0;
  width: 240px;
  max-width: 80vw;
  aspect-ratio: 1 / 1;
  object-fit: cover;
  border-radius: 14px;
  border: 1px solid rgba(55, 95, 122, 0.12);
  background: #fff;
}

.re-preview .pdf-wrap {
  margin-top: 10px;
  border: 1px solid rgba(55, 95, 122, 0.12);
  border-radius: 14px;
  overflow: hidden;
  background: #fff;
  max-width: 100%;
}

.re-preview .pdf-wrap embed {
  width: 100%;
  height: 320px;
  display: block;
}

/* Form */
.re-form-section {
  border: 1px solid var(--border);
  border-radius: 20px;
  padding: 26px;
}

.re-form {
  margin-top: 12px;
  display: grid;
  gap: 14px;
}

.re-label {
  font-size: 13px;
  font-weight: 700;
  color: var(--secondary);
}

.re-input {
  width: 100%;
  padding: 12px 14px;
  border-radius: 14px;
  border: 1px solid var(--border);
  font-size: 14px;
  background: #fff;
}

.re-input:focus {
  outline: none;
  border-color: var(--primary);
  box-shadow: 0 0 0 3px var(--primary-ring);
}

/* Buttons */
.btn {
  display: inline-flex;
  align-items: center;
  justify-content: center;
  gap: 10px;
  padding: 14px 20px;
  border-radius: 14px;
  font-size: 15px;
  font-weight: 800;
  cursor: pointer;
  text-decoration: none;
  user-select: none;
  border: 1px solid transparent;
  transition: transform 0.06s ease, filter 0.12s ease, box-shadow 0.12s ease;
}

.btn:active {
  transform: translateY(1px);
}

.btn:focus {
  outline: none;
  box-shadow: 0 0 0 3px var(--primary-ring);
}

.btn-primary {
  width: 100%;
  background: var(--primary);
  color: #fff;
}

.btn-primary:hover {
  filter: brightness(0.96);
}

.btn-secondary {
  background: var(--secondary);
  color: #fff;
}

.btn-secondary:hover {
  filter: brightness(0.96);
}

/* Footer */
.re-footer {
  padding: 18px 28px;
  border-top: 1px solid var(--border);
  display: flex;
  justify-content: flex-end;
}

.re-link {
  font-size: 14px;
  font-weight: 800;
  color: var(--secondary);
  text-decoration: none;
}

.re-link:hover {
  color: var(--primary);
}

/* Responsive */
@media (max-width: 640px) {
  .re-wrap {
    padding: 34px 14px;
  }

  .re-header {
    padding: 22px 18px 18px;
  }

  .re-body {
    padding: 20px;
    gap: 22px;
  }

  .re-qr-section {
    padding: 20px;
  }

  .re-qr-box {
    padding: 12px;
    max-width: 320px;
  }

  .re-form-section {
    padding: 18px;
  }
}

.re-file {
  padding: 10px 0;
  border: none;
  background: none;
  font-size: 14px;
  color: var(--secondary);
}
.re-file::-webkit-file-upload-button {
  background: var(--primary);
  color: #fff;
  border: none;
  border-radius: 8px;
  padding: 10px 18px;
  font-weight: 700;
  font-size: 14px;
  cursor: pointer;
  transition: background 0.18s;
}
.re-file::-webkit-file-upload-button:hover {
  background: var(--secondary);
}
.re-file::file-selector-button {
  background: var(--primary);
  color: #fff;
  border: none;
  border-radius: 8px;
  padding: 10px 18px;
  font-weight: 700;
  font-size: 14px;
  cursor: pointer;
  transition: background 0.18s;
}
.re-file::file-selector-button:hover {
  background: var(--secondary);
}

</style>

<div class="re-wrap">
  <div class="re-card">

    <header class="re-header">
      <div class="re-icon" aria-hidden="true">✓</div>
      <h1 class="re-title">Registro exitoso</h1>
      <p class="re-subtitle">
        Gracias, <strong>{{ $registro->nombre_estudiante }}</strong>.
        Tu registro fue guardado correctamente.
      </p>
    </header>

    <main class="re-body">

      <section class="re-qr-section" aria-labelledby="qr-title">
        <h2 id="qr-title" class="re-h2">Código QR de tu reserva</h2>
        <p class="re-p">Inversión: <strong>{{ $inversion !== null ? 'Bs./ ' . number_format($inversion, 2) : 'S/ --' }}</strong><br><span style="font-size:12px;color:var(--muted)">(Puedes reservar con un monto menor al total)</span></p>
        <div class="re-qr-box">
          <img class="re-qr-img" src="{{ $qrImage }}" alt="Código QR de la reserva" loading="lazy">
        </div>

        <a href="{{ $qrImage }}" download="qr_reserva.jpg" class="btn btn-secondary">
          Descargar QR
        </a>
      </section>

      <section class="re-form-section" aria-labelledby="comp-title">
        <h2 id="comp-title" class="re-h2">Comprobante de pago</h2>
        <p class="re-p">Sube una imagen</p>

        <form
          class="re-form"
          action="{{ route('registro.subir_comprobante', $registro->id) }}"
          method="POST"
          enctype="multipart/form-data"
        >
          @csrf

          <input class="re-input re-file" id="comprobante" type="file" name="comprobante" accept="image/*,application/pdf" required>

<!-- Estilos personalizados para input file -->

          <div id="preview-comprobante" class="re-preview" aria-live="polite"></div>

          <button type="submit" class="btn btn-primary">
            Subir comprobante
          </button>
        </form>
      </section>

    </main>

    <footer class="re-footer">
      <a href="/" class="re-link">Volver al inicio →</a>
    </footer>

  </div>
</div>

<script>
  (function () {
    const input = document.getElementById('comprobante');
    const preview = document.getElementById('preview-comprobante');
    if (!input || !preview) return;

    input.addEventListener('change', () => {
      const file = input.files && input.files[0];
      preview.innerHTML = '';
      if (!file) return;

      const url = URL.createObjectURL(file);

      if (file.type.startsWith('image/')) {
        const img = document.createElement('img');
        img.src = url;
        img.alt = 'Vista previa del comprobante';
        img.onload = () => URL.revokeObjectURL(url);
        preview.appendChild(img);
        return;
      }

      if (file.type === 'application/pdf') {
        const wrap = document.createElement('div');
        wrap.className = 'pdf-wrap';

        const embed = document.createElement('embed');
        embed.src = url;
        embed.type = 'application/pdf';

        wrap.appendChild(embed);
        preview.appendChild(wrap);
        return;
      }

      const p = document.createElement('p');
      p.style.marginTop = '10px';
      p.style.fontSize = '14px';
      p.style.color = 'rgba(55,95,122,.78)';
      p.textContent = 'Archivo seleccionado: ' + file.name;
      preview.appendChild(p);
    });
  })();
</script>
@endsection
