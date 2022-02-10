@extends('layouts.plantillabase')
@yield('Title', 'Loser')
<div class ="">
    <span>El pitjor jugador del sistema és {{$jugador->nickname}} amb un {{$jugador->percentatge_exit}}</span>
</div>