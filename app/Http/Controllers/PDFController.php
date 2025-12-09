<?php

namespace App\Http\Controllers;

use App\Models\Modalidad;
use App\Models\Product;
use App\Models\Info;
use App\Models\Social;
use App\Models\Location;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class PDFController extends Controller
{
    public function generarPDF(Product $product)
    {
        $product->load('modalidades.dias','modalidades.horarios','modalidades.ventajas','contenidos','materiales');
        $datos = [
            'product' => $product,
            'info' => Info::first(),
            'socials' => Social::where('state', true)->orderBy('priority')->get(),
            'location' => Location::first(),
        ];

        // Cargar la vista y pasarle los datos
        $pdf = Pdf::loadView('modalidades.pdfproduct', $datos);

        // Descargar el PDF
        return $pdf->download($product->nombre."_Modalidades".'.pdf');
    }

    
    public function modalidad_pdf(Modalidad $modalidad)
    {
        $modalidad->load('dias','horarios','ventajas','product.contenidos','product.materiales','product.modalidades.ventajas');
        $datos = [
            'modalidad' => $modalidad,
            'info' => Info::first(),
            'socials' => Social::where('state', true)->orderBy('priority')->get(),
            'location' => Location::first(),
        ];

        // Cargar la vista y pasarle los datos
        $pdf = Pdf::loadView('modalidades.pdfmodalidad', $datos);

        // Descargar el PDF
        return $pdf->download($modalidad->modalidad.'.pdf');
    }
}
