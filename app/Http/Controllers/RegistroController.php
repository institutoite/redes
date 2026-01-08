<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Registro;
use Illuminate\Support\Facades\Storage;

class RegistroController extends Controller
{
    public function subirComprobante(Request $request, $id)
    {
        $request->validate([
            'comprobante' => 'required|file|mimes:jpg,jpeg,png,pdf',
        ]);
        $registro = Registro::findOrFail($id);
        $rutaComprobante = $request->file('comprobante')->store('comprobantes', 'public');
        $registro->comprobante = $rutaComprobante;
        $registro->reservado = true;
        $registro->save();
        return view('registro.reserva_realizada', compact('registro'));
    }
    public function pdf($id)
    {
        $registro = \App\Models\Registro::findOrFail($id);
        $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('registro.pdfreserva', compact('registro'));
        return $pdf->download('Comprobante_Reserva_'.$registro->nombre_estudiante.'.pdf');
    }
    public function create(Request $request)
    {
        $requerimiento = $request->query('requerimiento', '');
        return view('registro.create', compact('requerimiento'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nombre_estudiante' => 'required|string|max:255',
            'fecha_nacimiento' => 'required|date',
            'requerimiento' => 'required|string',
            'como_nos_conocio' => 'required|in:facebook,instagram,web,recomendacion,otro',
            'nombre_apoderado' => 'required|string|max:255',
            'telefono_apoderado' => 'required|numeric|digits_between:7,20',
        ]);

        $registro = Registro::create($validated);

        return redirect()->route('registro.show', $registro->id);
    }

    public function show($id)
    {
        $registro = Registro::findOrFail($id);
        // El QR es una imagen estática (por ejemplo, public/images/qr.jpg)
        $qrImage = asset('images/qr.jpg');
        return view('registro.show', compact('registro', 'qrImage'));
    }
}
