
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Comprobante de Reserva</title>
    <style>
        body {
            font-family: 'Segoe UI', Arial, sans-serif;
            background: #f4f6fa;
            margin: 0;
            padding: 0;
        }
        .pdf-container {
            background: #fff;
            max-width: 600px;
            margin: 32px auto;
            border-radius: 12px;
            box-shadow: 0 4px 24px rgba(55,95,122,0.10);
            border: 1.5px solid #e3e8ee;
            padding: 32px 36px 28px 36px;
        }
        .header {
            display: flex;
            align-items: center;
            border-bottom: 2px solid #26baa5;
            padding-bottom: 12px;
            margin-bottom: 24px;
        }
        .logo {
            height: 54px;
            margin-right: 18px;
        }
        .brand-title {
            font-size: 1.7em;
            color: #375f7a;
            font-weight: 700;
            letter-spacing: 1px;
        }
        .section {
            margin-bottom: 18px;
            padding: 14px 18px;
            background: #f8fafc;
            border-radius: 7px;
            border-left: 4px solid #26baa5;
            box-shadow: 0 1px 4px rgba(38,186,165,0.04);
        }
        .label {
            font-weight: 600;
            color: #26baa5;
            font-size: 1.08em;
        }
        .value {
            margin-left: 8px;
            color: #375f7a;
            font-size: 1.08em;
        }
        .qr {
            margin: 28px 0 18px 0;
            text-align: center;
        }
        .footer {
            margin-top: 32px;
            font-size: 1em;
            color: #888;
            text-align: center;
        }
        .comprobante-img {
            display: block;
            margin: 18px auto 0 auto;
            border-radius: 8px;
            border: 1.5px solid #e3e8ee;
            max-width: 350px;
            max-height: 500px;
            box-shadow: 0 2px 12px rgba(55,95,122,0.08);
        }
    </style>
</head>
<body>
    <div class="pdf-container">
        <div class="header">
            <img src="{{ public_path('images/logo.png') }}" alt="Logo" class="logo">
            <span class="brand-title">Comprobante de Reserva</span>
        </div>
        <div class="section">
            <span class="label">Estudiante:</span>
            <span class="value">{{ $registro->nombre_estudiante }}</span>
        </div>
        <div class="section">
            <span class="label">Fecha de nacimiento:</span>
            <span class="value">{{ $registro->fecha_nacimiento->format('d/m/Y') }}</span>
        </div>
        <div class="section">
            <span class="label">Requerimiento:</span>
            <span class="value">{!! $registro->requerimiento !!}</span>
        </div>
        <!-- Sección '¿Cómo nos conoció?' eliminada por ser de uso interno -->
        <div class="section">
            <span class="label">Apoderado:</span>
            <span class="value">{{ $registro->nombre_apoderado }}</span>
        </div>
        <div class="section">
            <span class="label">Teléfono apoderado:</span>
            <span class="value">{{ $registro->telefono_apoderado }}</span>
        </div>
        @if(!empty($registro->comprobante))
        <div class="section" style="text-align:center;">
            <span class="label">Comprobante adjunto:</span><br>
            <img src="{{ public_path('storage/' . $registro->comprobante) }}" alt="Comprobante" class="comprobante-img">
        </div>
        @endif
        <div class="qr">
            <img src="{{ public_path('images/qr.jpg') }}" alt="QR de reserva" style="max-width:120px;">
        </div>
        <div class="footer">
            <div>Fecha de reserva: {{ now()->format('d/m/Y H:i') }}</div>
            <div>Este comprobante puede ser enviado por WhatsApp para agilizar la validación.</div>
        </div>
    </div>
</body>
</html>
</html>
