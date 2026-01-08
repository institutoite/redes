@extends('layouts.base')

@section('content')
<div class="container mx-auto max-w-lg p-6 brand-card text-center">
    <h2 class="text-2xl font-bold mb-4 brand-title">¡Registro Exitoso!</h2>
    <p class="mb-4">Gracias, <span class="brand-subtitle">{{ $registro->nombre_estudiante }}</span>. Tu registro ha sido guardado correctamente.</p>
    <div class="mb-4">
        <p class="font-semibold">Código QR para tu reserva:</p>
        <div class="flex flex-col items-center gap-2">
            <img id="qr-img" src="{{ $qrImage }}" alt="QR de reserva" class="mx-auto" style="max-width:200px;">
            <a href="{{ $qrImage }}" download="qr_reserva.jpg" class="mt-2 brand-btn">Descargar QR</a>
        </div>
    </div>
    <div class="mb-4">
        <form action="{{ route('registro.subir_comprobante', $registro->id) }}" method="POST" enctype="multipart/form-data" class="flex flex-col items-center gap-2">
            @csrf
            <label class="block font-semibold">Subir comprobante del pago realizado</label>
            <input type="file" name="comprobante" accept="image/*,application/pdf" class="mb-2" onchange="previewComprobante(event)">
            <div id="preview-comprobante" class="mb-2"></div>
            <button type="submit" class="brand-btn">Subir comprobante</button>
        </form>
        <script>
        function previewComprobante(event) {
            const file = event.target.files[0];
            const preview = document.getElementById('preview-comprobante');
            preview.innerHTML = '';
            if (!file) return;
            if (file.type.startsWith('image/')) {
                const img = document.createElement('img');
                img.src = URL.createObjectURL(file);
                img.className = 'mx-auto rounded shadow';
                img.style.maxWidth = '200px';
                img.onload = () => URL.revokeObjectURL(img.src);
                preview.appendChild(img);
            } else if (file.type === 'application/pdf') {
                const pdf = document.createElement('embed');
                pdf.src = URL.createObjectURL(file);
                pdf.type = 'application/pdf';
                pdf.width = '200';
                pdf.height = '250';
                preview.appendChild(pdf);
            } else {
                preview.textContent = 'Archivo seleccionado: ' + file.name;
            }
        }
        </script>
    </div>
    <div class="flex justify-end mb-2">
        <a href="/" class="brand-btn">Volver al inicio</a>
    </div>
</div>
@endsection
