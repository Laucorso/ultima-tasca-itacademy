<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Partida;
use App\Models\Jugador;

class JugadorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function llistatJugadors() //OK
    {
        $jugadors = Jugador::all();
        return view('jugadors.llistatJugadors', compact('jugadors'));
    }


    public function percentatgeExitTotal() 
    {
       $jugadors = Jugador::all();
       $percentatgeSumatori = 0;
       foreach ($jugadors as $jugador)
       {
            $percentatgeSumatori =  $percentatgeSumatori + $jugador->percentatge_exit;
       }

        $jugadors = Jugador::all()->count();
        $percentatgeExit = $percentatgeSumatori/$jugadors;
       
        return view('rankings.rankingTotals', compact('percentatgeExit'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $jugador = Jugador::findOrFail($id);
        return view('jugadors.show', compact('jugador'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $jugador = Jugador::find($id);
        return view('jugadors.edit', compact('jugador'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Jugador $id)
    {
        $request->validate([
            'nickname' => 'unique|required|min:3|string',
        ]);
        $jugador = Jugador::find($id);
        $jugador -> nickname = $request -> input('nickname');
        $jugador ->update();
        return redirect()->route('partides.indexByJugador');
    }

}
