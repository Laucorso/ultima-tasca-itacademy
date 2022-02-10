<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Partida;
use App\Models\User;

class Jugador extends Model
{
    use HasFactory;

    protected $appends = ['percentatge_exit'];

    public function getPercentatgeExitAttribute()
    {
        
        return $this->partidas->count() * 100 / $this->partidas->where('resultat', '1')->count();
        
    }

    public function user(){
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
    public function partidas(){
        return $this->hasMany(Partida::class);
    }
    
}
