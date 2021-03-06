<?php

namespace App\Http\Controllers;
use App\Models\Partida;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PartidaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    public function __construct(){
        
        $this->middleware('can:vistaJugador')->only('indexByJugador');
    }
    
    public function indexByJugador($id) //OK
    {
        $jugador = auth::user()->jugador;
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
        $jugador = auth::user()->jugador;
        $dau1 = rand(1,6);
        $dau2 = rand(1,6);

        if ($dau1+$dau2 === 7){
            $resultat = true;
        }else{
            $resultat = false;
        };
       
        $partidaNova = Partida::create([
            'dau1' => $dau1,
            'dau2' => $dau2,
            'resultat' => $resultat,
            'jugador_id' => $jugador->id,
        ]);
        
        return redirect()->route('vistaJugador', compact(['id','partidaNova']))->with(['success' => 'Partida Realitzada Amb Èxit']);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {   
        //$jugador = Jugador::where('user_id', $id)->get();
        //dd($jugador);
        
        $jugador = Auth::user()->jugador;
        $partides = Partida::where('jugador_id', $jugador->id)->get()->each->delete();
        return redirect()->route('vistaJugador', compact('id', 'partides'))->with(['success' => 'Partides eliminades amb èxit']);
    }
}
