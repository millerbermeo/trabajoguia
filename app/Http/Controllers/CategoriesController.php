<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        if ($user->role == 'ADMIN') {
            return response()->json([
                'message'=> 'usuario autorizado'
            ], 401);

            $categories = Categories::all();
            return response()->json($categories, 200);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $user = Auth::user();
        if ($user->role == 'USER') {
            return response()->json([
                'message'=> 'usuario autorizado'
            ], 401);
        }

        $request -> validate([
            'name' => 'required|string',
            'descripcion' => 'required|string'
        ]);

        $categorie = Categories::create([
            'name'=> $request->name,
            'descripcion'=> $request->descripcion
        ]);

        return response()->json([
            'message'=> 'categoria creada'
        ]);


        } catch (\Exception $e) {   
            
        return response()->json([
            'message'=> 'datos no procesados'
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
                'message'=> 'usuario autorizado'
            ], 401);

            $categorie = Categories::find($id);
            return response()->json($categorie, 200);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
