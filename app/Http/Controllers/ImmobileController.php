<?php

namespace App\Http\Controllers;

use App\Http\Requests\ImmobileRequest;
use App\Models\Immobile;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ImmobileController extends Controller
{
    public function create()
    {
        $immobile = Immobile::with('photos')->get();
        return Inertia::render('Create', [
            'immobile' => $immobile
        ]);
    }
   
    public function store(ImmobileRequest $request)
    {
        // dd($request->photo());
        $immobile = Immobile::create([
            'title' => $request->title,
            'description' => $request->description,
            'price' => $request->price,
            'street' => $request->street,
            'number' => $request->number,
            'neighborhood' => $request->neighborhood,
            'city' => $request->city,
            'state' => $request->state,
        ]);

        if ($request->hasFile('photos')) {
            foreach ($request->file('photos') as $photo) {
                $name = $photo->getClientOriginalName();

                // $path = $photo->store('public/photos/' . $user->id);
                $path = $photo->store('public/photos');
                $path = str_replace('public/', '', $path);

                $immobile->photos()->create([
                    'photo_path' => $path 
                ]);
            }
        }
    }

}
