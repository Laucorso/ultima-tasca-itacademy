@extends('layouts.plantillabase')
@yield('Title', 'Winner')
@yield('content')
<div class ="">
    <span>El millor jugador del sistema és {{$jugador->nickname}} amb un {{$jugador->percentatge_exit}}</span>
</div>