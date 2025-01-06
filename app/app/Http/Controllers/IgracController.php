<?php

namespace App\Http\Controllers;

use App\Models\Player;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class IgracController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $igraci = Player::with('partner')->get();
        return response()->json([
                                    'status' => 'success',
                                    'message' => 'Igrači uspješno pronađeni.',
                                    'data' => $igraci
                                ], 200);
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
        try {
            $validated = $request->validate([
                                                'ime' => 'required|string|max:255',
                                                'prezime' => 'required|string|max:255',
                                                'zemlja' => 'required|string|max:255',
                                                'visina' => 'required|integer|min:100|max:250',
                                                'datum_rodjenja' => 'required|date|before:today',
                                                'glavna_strana' => 'required|string|in:lijevo,desno',
                                                'partner_id' => 'nullable|exists:igraci,id',
                                                'ranking' => 'required|integer|min:1',
                                                'broj_odigranih_matcheva' => 'required|integer|min:0',
                                                'postotak_pobjeda' => 'required|numeric|min:0|max:100',
                                            ]);

        } catch (ValidationException $e) {
            return response()->json([
                                        'status' => 'error',
                                        'message' => 'Validacija nije prošla.',
                                        'errors' => $e->errors()
                                    ], 422);
        }


        $igrac = Player::create($validated);
        return response()->json([
                                    'status' => 'success',
                                    'message' => 'Igrač uspješno kreiran.',
                                    'data' => $igrac
                                ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $igrac = Player::with('partner')->find($id);

        if (!$igrac) {
            return response()->json([
                                        'status' => 'error',
                                        'message' => 'Igrač ne postoji.',
                                        'data' => null
                                    ], 404);
        }

        return response()->json([
                                    'status' => 'success',
                                    'message' => 'Igrač postoji.',
                                    'data' => $igrac
                                ], 200);
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
        $igrac = Player::find($id);

        if (!$igrac) {
            return response()->json([
                                        'status' => 'error',
                                        'message' => 'Igrač ne postoji.',
                                        'data' => null
                                    ], 404);
        }

        try {
            $validated = $request->validate([
                                                'ime' => 'sometimes|required|string|max:255',
                                                'prezime' => 'sometimes|required|string|max:255',
                                                'zemlja' => 'sometimes|required|string|max:255',
                                                'visina' => 'sometimes|required|integer|min:100|max:250',
                                                'datum_rodjenja' => 'sometimes|required|date|before:today',
                                                'glavna_strana' => 'sometimes|required|string|in:lijevo,desno',
                                                'partner_id' => 'nullable|exists:igraci,id',
                                                'ranking' => 'sometimes|required|integer|min:1',
                                                'broj_odigranih_matcheva' => 'sometimes|required|integer|min:0',
                                                'postotak_pobjeda' => 'sometimes|required|numeric|min:0|max:100',
                                            ]);

        } catch (ValidationException $e) {
            return response()->json([
                                        'status' => 'error',
                                        'message' => 'Validacija nije prošla.',
                                        'errors' => $e->errors()
                                    ], 422);
        }
        $igrac->update($validated);
        return response()->json([
                                    'status' => 'success',
                                    'message' => 'Igrač uspješno ažuriran.',
                                    'data' => $igrac
                                ], 200);



    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $igrac = Player::find($id);

        if (!$igrac) {
            return response()->json(['error' => 'Igrač ne postoji'], 404);
        }

        $igrac->delete();
        return response()->json(['message' => 'Igrač obrisan'], 200);
    }

    public function showPartner($id)
    {
        $igrac = Player::with('partner')->find($id);

        if (!$igrac) {
            return response()->json([
                                        'status' => 'error',
                                        'message' => 'Igrač ne postoji.',
                                        'data' => null
                                    ], 404);
        }

        if (!$igrac->partner) {
            return response()->json([
                                        'status' => 'error',
                                        'message' => 'Igrač nema partnera.',
                                        'data' => null
                                    ], 404);
        }

        return response()->json([
                                    'status' => 'success',
                                    'message' => 'Partner uspješno dohvaćen.',
                                    'data' => $igrac->partner
                                ], 200);
    }

    public function getByZemlja($zemlja)
    {
        $igraci = Player::where('zemlja', $zemlja)->get();

        if ($igraci->isEmpty()) {
            return response()->json([
                                        'status' => 'error',
                                        'message' => 'Nema igrača iz zadane zemlje.',
                                        'data' => null
                                    ], 404);
        }

        return response()->json([
                                    'status' => 'success',
                                    'message' => 'Igrači uspješno dohvaćeni.',
                                    'data' => $igraci
                                ], 200);
    }

    public function getByGlavnaStrana($strana)
    {
        $igraci = Player::where('glavna_strana', $strana)->get();

        if ($igraci->isEmpty()) {
            return response()->json([
                                        'status' => 'error',
                                        'message' => 'Nema igrača s tom stranom',
                                        'data' => null
                                    ], 404);
        }

        return response()->json([
                                    'status' => 'success',
                                    'message' => 'Lista igrača s glavnom stranom.',
                                    'data' => $igraci
                                ], 200);
    }
}
