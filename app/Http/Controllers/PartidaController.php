<?php

namespace App\Http\Controllers;
use App\Models\Partida;
use App\Models\Jugador;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PartidaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    public function indexByJugador($id) //OK
    {
        $jugador = Jugador::find($id);
        $partides = $jugador->partidas;
        return view('partides.indexByJugador', compact('partides', 'jugador')); 
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id)
    {

        $jugador = Jugador::find($id);
        dd($request->input('dau1'));
        $request->validate([
            'dau1' => 'integer|min:1|max:6|required',
            'dau2' => 'integer|min:1|max:6|required',
        ]);
        

        if ('dau1'+'dau2' === 7){
            $resultat = true;
        }else{
            $resultat = false;
        };

        Partida::create([
            'dau1' => 2,
            'dau2' => 2,
            'resultat' => TRUE,
            'jugador_id' => 1
        ]);
        
        return redirect()->route('partides.indexByJugador', compact(['id' =>$jugador->id], 'partida'));
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {   
        $jugador = Jugador::find($id);
        $partides = $jugador->partidas;
        $partides->delete();
        return redirect()->route('partides.indexByJugador');
    }
}
