<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Places;

class PlacesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        if ($user->role== 'ADMIN') {
            return response()->json([
                'message'=>'usurio no autorizado'
            ], 401);

            $places = Places::all();
            return response()->json($places, 200);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $user = Auth::user();
            if ($user->role == 'ADMIN') {
                return response()->json([
                    'name' => 'required|string',
                    'descripcion' => 'required|string',
                    'addres' => 'required|string',
                    'id_categories' => 'required'
                ]);

                $places = Places::create([
                    'name'=>$request->name,
                    'descripcion'=>$request->descripcion,
                    'addres'=>$request->addres,
                    'id_categories'=> $request->id_categories
                ]);

                return response()->json([
                    'message'=> 'places creado'
                ]);
            }
        } catch (\Exception $e) {
            return response()->json([
                'message'=>'datos no procesados'
            ]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $user = Auth::user();
        if ($user->role == 'ADMIN') {
            return response()->json([
                'message'=>'usurio autorizado'
            ]);

            $place = Places::find($id);
            return response()->json($place, 200);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $user = Auth::user();
            if ($user->role == 'ADMIN') {
                return response()->json([
                    'name' => 'required|string',
                    'descripcion' => 'required|string',
                    'addres' => 'required|string',
                    'id_categories' => 'required'
                ]);

                Places::update($request->all());

                return response()->json([
                    'message'=> 'actualizado correctamente'
                ]);
            }
        } catch (\Exception $e) {
            return response()->json([
                'message'=>'datos no procesados'
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {

            $user = Auth::user();
            if ($user->role == 'USER') {
                return response()->json([
                    'message'=>'no autroizado'
                ]); 
            }


            Places::destroy($id);
            return response()->json([
                "message" => "places elimando conrrectamente"
            ]);
            
        } catch (\Exception $e) {
            return response()->json([
                'message'=> 'los datos no han sido eliminados'
            ]);
        }
    }
}
