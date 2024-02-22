<?php

namespace App\Http\Controllers;

use App\Models\Immobile;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ImmobileController extends Controller
{
    public function index()
    {
        return Inertia::render('Dashboard');
    }

    public function create()
    {
        return Inertia::render('Create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => ['required', 'max:255'],
            'description' => ['required'],
            'price' => ['required', 'numeric'],
        ]);

        Immobile::create($request->all());
    }
}
