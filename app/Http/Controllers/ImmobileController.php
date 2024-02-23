<?php

namespace App\Http\Controllers;

use App\Http\Requests\ImmobileRequest;
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

    public function store(ImmobileRequest $request)
    {
        Immobile::create([
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'price' => $request->input('price'),
        ]);
    }
}
