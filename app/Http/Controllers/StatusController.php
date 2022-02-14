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
        //return view('rankings.rankingWinner', compact('jugador')); 

        foreach($jugadors as $jugador){
            
            $partidesTotals = Partida::where('jugador_id', $jugador->id)->count();
            $partidesGuanyades = $jugador->partidas_guanyades;
            $percentatge = round($partidesGuanyades*100/$partidesTotals);
            $jugadorsByEstadistica[] = ([
                'jugador_id' =>$jugador->id,
                'partidesTotals' => $partidesTotals,
                'partidesGuanyades' => $partidesGuanyades,
                'percentatge' => $percentatge
            ]);

            $percentatge = [];
            foreach ($jugadorsByEstadistica as $key => $row) {
                $percentatge[$key] = $row['percentatge'];
            }

        }
            array_multisort($percentatge, SORT_DESC, $jugadorsByEstadistica); //estic ordenant els elements pel VALOR percentatge. descendent                               
            $workingArray = json_encode($jugadorsByEstadistica[0],true); //json_encode() creates a json string from an array or data
            return view('rankings.rankingLoser', with(['jugadorsByEstadistica' => $workingArray]));

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
            $workingArray = json_encode($jugadorsByEstadistica[0],true); //json_encode() creates a json string from an array or data
            return view('rankings.rankingLoser', with(['jugadorsByEstadistica' => $workingArray]));
            
    }
        
}
