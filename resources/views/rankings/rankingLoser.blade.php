@extends('layouts.plantillabase')
@yield('Title', 'Loser')
<div class ="">
    
    <span>El pitjor jugador del sistema és el jugador amb id {{$jugador->id}},  amb un total de {{$jugador->partidas_perdudes}} partides perdudes</span>
</div>