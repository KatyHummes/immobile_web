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
        $immobile = Immobile::with('photos')->get();
        return Inertia::render('Create', [
            'immobile' => $immobile
        ]);
    }

    public function store(ImmobileRequest $request)
    {
        // dd($request->all())
        Immobile::create([
            'title' => $request->title,
            'description' => $request->description,
            'price' => $request->price,
            'street' => $request->street,
            'number' => $request->number,
            'neighborhood' => $request->neighborhood,
            'city' => $request->city,
            'state' => $request->state,
        ]);
    }
}
