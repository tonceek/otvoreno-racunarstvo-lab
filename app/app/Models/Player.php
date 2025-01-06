<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Player extends Model
{

    protected $table = 'players';

    protected $primaryKey = 'id';

    public $timestamps = false;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'ime',
        'prezime',
        'zemlja',
        'visina',
        'datum_rodjenja',
        'glavna_strana',
        'partner_id',
        'ranking',
        'broj_odigranih_meceva',
        'postotak_pobjeda'

    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected $casts = [
        'visina' => 'integer',
        'ranking' => 'integer',
        'broj_odigranih_matcheva' => 'integer',
        'postotak_pobjeda' => 'float'
    ];
    protected $dates = ['datum_rodjenja'];
    public function partner()
    {
        return $this->belongsTo(Player::class, 'partner_id');
    }
}
