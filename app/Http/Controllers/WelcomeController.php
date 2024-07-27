<?php

namespace App\Http\Controllers;

use App\Models\Location;
use App\Models\Social;
use App\Models\Product;
use Illuminate\Http\Request;
use Inertia\Inertia;


class WelcomeController extends Controller
{
    public function index()
    {
        $socials = Social::where('state', 1)->orderBy('priority')->get();
        $products = Product::with('category')->get();
        $locations = Location::all();

        return view('Welcome', [
            'socials' => $socials,
            'products' => $products,
            'locations' => $locations,
        ]);
    }
}
