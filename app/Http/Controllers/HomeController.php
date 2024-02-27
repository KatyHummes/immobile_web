<?php

namespace App\Http\Controllers;

use App\Models\Evaluation;
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
        $user = auth()->user();
        $immobiles = Immobile::all();
        return Inertia::render('Dashboard', [
            'immobiles' => $immobiles,
            'user' => $user,
        ]);
    }

    public function imovel($id)
    {
        $immobile = Immobile::with(['photos', 'evaluations', 'evaluations.user'])->find($id);

        return Inertia::render('Immobile', [
            'immobile' => $immobile,
        ]);
    }

    public function rating(Request $request, $id)
    {
        // dd($request->all(), $id);

        Evaluation::create([
            'user_id' => auth()->id(),
            'immobile_id' => $id,
            'comment' => $request->comment,
            'rating' => 5
        ]);
    }
}
