<?php

namespace App\Http\Controllers;

use App\Models\Modalidad;
use App\Models\Product;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class PDFController extends Controller
{
    public function generarPDF(Product $product)
    {
        // Datos para pasar a la vista
        $datos = [
            'titulo' => 'Reporte de Ejemplo',
            'contenido' => 'Este es el contenido del reporte.',
            'product'=>$product,
        ];

        // Cargar la vista y pasarle los datos
        $pdf = Pdf::loadView('modalidades.pdfmodalidad', $datos);

        // Descargar el PDF
        return $pdf->download($product->nombre."_Modalidades".'.pdf');
    }
}
