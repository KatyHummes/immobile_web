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
        $immobiles = Immobile::all();

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
}
