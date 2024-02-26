<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Immobile;
use Illuminate\Support\Facades\Route;
class HomeController extends Controller
{
    public function index()
    {
        $immobiles = Immobile::get()->load('photos');

        $canLogin = Route::has('login');
        $canRegister = Route::has('register');

        return Inertia::render('Welcome', [
            'immobiles' => $immobiles,
            'canLogin' => $canLogin,
            'canRegister' => $canRegister,
        ]);
    }

    public function show()
    {
        $immobiles = Immobile::all(); 
        return Inertia::render('Dashboard', [
            'immobiles' => $immobiles
        ]);
    }

    public function imovel($id)
    {
        $immobile = Immobile::with('photos')->find($id);
        return Inertia::render('Imovel', [
            'immobile' => $immobile
        ]);
    }
}
