<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Player;
use Illuminate\Support\Facades\Storage;

class DataRefreshController extends Controller
{
    public function refresh()
    {
        $players = Player::all();

        // Generiraj JSON datoteku
        Storage::disk('local')->put('players.json', $players->toJson());

        // Generiraj CSV datoteku
        $csvData = "Ime,Prezime,Zemlja,Visina,Datum rođenja,Glavna strana,Ranking,Broj odigranih mečeva,Postotak pobjeda\n";

        foreach ($players as $player) {
            $csvData .= "{$player->ime},{$player->prezime},{$player->zemlja},{$player->visina},{$player->datum_rodjenja},{$player->glavna_strana},{$player->ranking},{$player->broj_odigranih_meceva},{$player->postotak_pobjeda}\n";
        }

        Storage::disk('local')->put('players.csv', $csvData);

        return redirect('/')->with('message', 'Podaci uspješno osvježeni.');
    }
}
