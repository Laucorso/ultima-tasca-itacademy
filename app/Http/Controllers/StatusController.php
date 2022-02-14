<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Partida;

class StatusController extends Controller
{
    public function __construct()
    {
        
    }

    public function RankingWinner()
    {
        $jugadors = DB::table('jugadors')
        ->join('partidas', 'partidas.jugador_id','=', 'jugadors.id')
        ->select('jugadors.id', DB::raw('count(partidas.id) as partidas_guanyades'))
        ->where ('partidas.resultat', '1')
        ->groupBy('jugadors.id')
        ->get();
        return view('rankings.rankingWinner', compact('jugador')); 

    }
    

    public function RankingLoser() 
    {
        $jugadors = DB::table('jugadors')
        ->join('partidas', 'partidas.jugador_id', '=', 'jugadors.id')
        ->select('jugadors.id',  DB::raw('count(partidas.jugador_id) as partidas_perdudes'))
        ->where('partidas.resultat', '0')
        ->groupBy('jugadors.id')
        ->get();
    
        foreach($jugadors as $jugador){
            
            $partidesTotals = Partida::where('jugador_id', $jugador->id)->count();
            $partidesPerdudes = $jugador->partidas_perdudes;
            $percentatge = round($partidesPerdudes*100/$partidesTotals);
            $jugadorsByEstadistica[] = ([
                'jugador_id' =>$jugador->id,
                'partidesTotals' => $partidesTotals,
                'partidesPerdudes' => $partidesPerdudes,
                'percentatge' => $percentatge
            ]);


            $percentatge = [];
            foreach ($jugadorsByEstadistica as $key => $row) {
                $percentatge[$key] = $row['percentatge'];
            }

        }
            array_multisort($percentatge, SORT_DESC, $jugadorsByEstadistica); //estic ordenant els elements pel VALOR percentatge. descendent
            dd($jugadorsByEstadistica[0]); //agafo l'element 0 de l'array però estic perdent el grup d'array anterior? no manté l'associació amb les key?
            return view('rankings.rankingLoser', );
            
    }
        
}
