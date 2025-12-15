<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Info;

class ProductController extends Controller
{

    public function modalidades(Product $product){
        // Incrementar el contador de clicks
        $product->increment('clicks');
        // Cargar solo relaciones necesarias
        $modalidades = $product->modalidades()->where('estado', true)->with(['dias', 'ventajas'])->get();
        $beneficios = $product->beneficios()->where('estado', true)->get();
        $contenido = $product->contenidos()->where('estado', true)->orderBy('subnivel')->orderBy('orden')->get();
        $materiales = $product->materiales()->where('estado', true)->orderBy('orden')->get();
        $horarios = $product->horarios()->get();
        $info = Info::first();
        return view('modalidades.show', compact('product','info', 'modalidades','beneficios','contenido','materiales','horarios'));
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
