@extends('layouts.plantillabase')
@yield('title', 'Winner')
@yield('content')
<div class ="">
    <span>El millor jugador del sistema és el jugador amb id {{$jugador->id}}, amb un total de {{$jugador->partidas_guanyades}} partides guanyades</span>
</div>