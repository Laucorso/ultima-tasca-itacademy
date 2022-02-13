<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Partida;
use App\Models\User;

class Jugador extends Model
{
    use HasFactory;

    protected $appends = ['percentatge_exit'];  //puc fer foreach agafant un per un tots els percentatges exit? i el q vull es ordenarlos de major a menor

    public function getPercentatgeExitAttribute()
    {   
        $percentatge = 0;
        
        if($this->partidas->count()>0){
            return round($this->partidas->where('resultat', '1')->count() * 100/ $this->partidas->count());
        }else{
            return $percentatge;
        }
    }

    public function user(){
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
    public function partidas(){
        return $this->hasMany(Partida::class);
    }
    
}
