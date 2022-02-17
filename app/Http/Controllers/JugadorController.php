<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Jugador;
use App\Models\User;

class JugadorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct(){
        $this->middleware('can:edit.nickname')->only('edit','update');
        $this->middleware('can:vistaAdmin')->only('llistatJugadors');
        $this->middleware('can:rankingtotal')->only('percentatgeExitTotal');
        $this->middleware('can:jugadors.show')->only('show');

    }

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
        $id = auth::user()->id;
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
    public function update(Request $request, $id)
    {
    
        $request->validate([
            'nickname' => 'required|unique:jugadors,nickname|min:3|string',
        ]);
        $jugador = Jugador::find($id);
        $jugador -> nickname = $request -> input('nickname');
        $jugador ->update();
        return view('jugadors.show', compact('id', 'jugador'))->with(['success' => 'Nickname actualitzat amb èxit']);
    
    }

}
