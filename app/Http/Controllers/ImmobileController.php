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
        // dd($request->all());
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
            $user = auth()->user();

            foreach ($request->file('photos') as $photo) {
                $path = $photo->store('public/photos/' . $user->id);
                $path = str_replace('public/', '', $path);

                $immobile->photos()->create([
                    'photo_path' => $path,
                    'user_id' => $user->id
                ]);
            }
        }
    }

   
}
