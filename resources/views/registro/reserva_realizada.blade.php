@extends('layouts.base')

@section('content')
<div class="container mx-auto max-w-lg p-6 brand-card text-center">
    <h2 class="text-2xl font-bold mb-4 brand-title">¡Reserva realizada!</h2>
    <p class="mb-4">Tu comprobante fue recibido correctamente.<br>
    En momentos verificaremos el pago y te daremos de alta. Te avisaremos por WhatsApp o teléfono.</p>
    <div class="mb-4 text-left">
        <div><span class="font-semibold">Estudiante:</span> {{ $registro->nombre_estudiante ?? '' }}</div>
        <div><span class="font-semibold">Fecha de nacimiento:</span> {{ isset($registro->fecha_nacimiento) ? $registro->fecha_nacimiento->format('d/m/Y') : '' }}</div>
        <div><span class="font-semibold">Requerimiento:</span> {!! $registro->requerimiento ?? '' !!}</div>
        <div><span class="font-semibold">¿Cómo nos conoció?:</span> {{ ucfirst($registro->como_nos_conocio ?? '') }}</div>
        <div><span class="font-semibold">Apoderado:</span> {{ $registro->nombre_apoderado ?? '' }}</div>
        <div><span class="font-semibold">Teléfono apoderado:</span> {{ $registro->telefono_apoderado ?? '' }}</div>
    </div>
    @if(isset($registro) && !empty($registro->id))
    <div class="mb-4">
        <a href="{{ route('registro.pdf', $registro->id) }}" class="brand-btn" target="_blank">Descargar PDF de reserva</a>
    </div>
    @endif
    <div class="flex justify-end mb-2">
        <a href="/" class="brand-btn">Volver al inicio</a>
    </div>
</div>
@endsection
