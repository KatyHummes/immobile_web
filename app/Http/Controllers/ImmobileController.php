<?php

namespace App\Http\Controllers;

use App\Http\Requests\ImmobileRequest;
use App\Models\Amenitie;
use App\Models\Immobile;
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
            'user_id' => auth()->user()->id,
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
                    'photo_path' => $path
                ]);
            }
        }

        Amenitie::create([
            'immobile_id' => $immobile->id,
            'tv' => $request->tv,
            'wifi' => $request->wifi,
            'air_conditioning' => $request->air_conditioning,
            'bathroom' => $request->bathroom,
            'moving' => $request->moving,
            'furnished' => $request->furnished,
            'garage' => $request->garage,
            'ordinance' => $request->ordinance,
            'reservation' => $request->reservation,
            'maintenance' => $request->maintenance,
            'payment' => $request->payment,
            'couple' => $request->couple,
            'smoker' => $request->smoker,
            'pets' => $request->pets,
            'visits' => $request->visits
        ]);

    }

    public function show()
    {
        $user = auth()->user();
        $immobiles = Immobile::with('photos', 'amenitie')->get();
        return Inertia::render('Dashboard', [
            'immobiles' => $immobiles,
            'user' => $user,
        ]);
    }

    public function update(ImmobileRequest $request, $id)
    {
        dd($request->all());
        $immobile = Immobile::find($id);

        $immobile->update([
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
                ]);
            }
        }

        $immobile->update([
            'tv' => $request->tv,
            'wifi' => $request->wifi,
            'air_conditioning' => $request->air_conditioning,
            'bathroom' => $request->bathroom,
            'moving' => $request->moving,
            'furnished' => $request->furnished,
            'garage' => $request->garage,
            'ordinance' => $request->ordinance,
            'reservation' => $request->reservation,
            'maintenance' => $request->maintenance,
            'payment' => $request->payment,
            'couple' => $request->couple,
            'smoker' => $request->smoker,
            'pets' => $request->pets,
            'visits' => $request->visits
        ]);
    }

    public function destroy($id)
    {
        // dd($id);
        $immobile = Immobile::findOrFail($id);
        $immobile->delete();
    }
}
