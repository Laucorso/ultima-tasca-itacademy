<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class StatusController extends Controller
{
    public function __construct()
    {
        
    }

    public function RankingWinner()
    {
        $jugador = DB::table('jugadors')
        ->join('partidas', 'partidas.jugador_id','=', 'jugadors.id')
        ->select('jugadors.id', DB::raw('count(partidas.id) as partidas_guanyades'))
        ->where ('partidas.resultat', '1')
        ->groupBy('jugadors.id')
        ->orderByDesc('partidas_guanyades')
        ->first();
        return view('rankings.rankingWinner', compact('jugador')); 

    }
    
    public function RankingLoser() 
    {
        $jugadors = DB::table('jugadors')
        ->join('partidas', 'partidas.jugador_id', '=', 'jugadors.id')
        ->select('jugadors.id',  DB::raw('count(partidas.jugador_id) as partidas_perdudes'))
        ->where('partidas.resultat', '0')
        ->groupBy('jugadors.id')
        ->orderByDesc('partidas_perdudes')
        ->first();
        return view('rankings.rankingLoser', compact('jugador'));

    }
}
