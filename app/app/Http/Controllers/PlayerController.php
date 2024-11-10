<?php

namespace App\Http\Controllers;

use App\Models\Player;
use Illuminate\Http\Request;

class PlayerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $players = Player::all();

        return view('datatable', ['players' => $players]);
    }

    public function search(Request $request)
    {
        $query = $request->input('query');
        $field = $request->input('field');

        $players = Player::query();

        if ($field === 'ime') {
            $players->where('ime', 'LIKE', '%' . $query . '%');
        } elseif ($field === 'prezime') {
            $players->where('prezime', 'LIKE', '%' . $query . '%');
        } else {
            // Search across all fields if "Sva polja" is selected
            $players->where(function ($q) use ($query) {
                $q->where('ime', 'LIKE', '%' . $query . '%')
                    ->orWhere('prezime', 'LIKE', '%' . $query . '%')
                    ->orWhere('zemlja', 'LIKE', '%' . $query . '%')
                    ->orWhere('visina', 'LIKE', '%' . $query . '%')
                    ->orWhere('datum_rodjenja', 'LIKE', '%' . $query . '%')
                    ->orWhere('glavna_strana', 'LIKE', '%' . $query . '%')
                    ->orWhere('ranking', 'LIKE', '%' . $query . '%')
                    ->orWhere('broj_odigranih_matcheva', 'LIKE', '%' . $query . '%')
                    ->orWhere('postotak_pobjeda', 'LIKE', '%' . $query . '%');
            });
        }

        $players = $players->with('partner')->get();

        return response()->json($players);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
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
