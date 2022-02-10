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
        ->join('partidas', 'partidas.id_jugadors','=', 'jugadors.id')
        ->select('jugadors.id', DB::raw('count(partidas.id) as partidas_guanyades'))
        ->where ('partidas.resultat', '=', '1')
        ->max('partidas_guanyades')
        ->get();
        return view('rankings.rankingWinner', compact('jugador')); 

    }
    public function RankingLoser()
    {
        $jugador = DB::table('jugadors')
        ->join('partidas', 'partidas.id_jugadors', '=', 'jugadors.id')
        ->select('jugadors.id', DB::raw('count(partidas.id) as partidas_perdudes'))
        ->where('partidas.resultat', '=', '0')
        ->max('partidas_perdudes')
        ->get();
        return view('rankings.rankingLoser', compact('jugador'));
    }
}
