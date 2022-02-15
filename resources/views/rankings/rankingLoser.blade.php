@extends('layouts.plantillabase')
@yield('Title', 'Loser')
@can('rankingLoser')



<div class ="">


   <h1>jugador ID =>   {{json_decode($jugadorsByEstadistica, true)['jugador_id']  }}</h1>
   <h1>Percentatge => {{json_decode($jugadorsByEstadistica, true)['percentatge']  }}</h1>


</div>
@endcan
