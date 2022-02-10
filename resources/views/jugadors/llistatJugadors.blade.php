@extends('layouts.plantillabase')
@yield('title', 'Llistat Jugadors')
@yield('content')

<table>
    <thead>
        <tr class = "font-sans md:text-xl lg:text-3xl">
            <th class ="border border-gray-400 px-4 py-2">ID</th>
            <th class ="border border-gray-400 px-4 py-2">Nickname</th>
            <th class ="border border-gray-400 px-4 py-2">Percentatge exit</th>
        </tr>
    </thead>
    <tbody>
        
        @foreach($jugadors as $jugador)
            <tr>
                <td class ="bg bg-gray-200 border border-gray-500 px-4 py-2">{{$jugador->id}}</td>
                <td class ="bg bg-gray-400 border border-gray-500 px-4 py-2">{{$jugador->nickname}}</td>
                <td class ="bg bg-gray-200 border border-gray-500 px-4 py-2">{{$jugador->percentatge_exit}}</td> 
            </tr>
        @endforeach
    </tbody>
</table>
        
        <div class ="">
            <a href = "{{route('rankings.rankingTotals')}}">Veure percentatge èxit total del sistema
                <button class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 border border-green-800 rounded">
                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" aria-hidden="true" role="img" width="1em" height="1em" preserveAspectRatio="xMidYMid meet" viewBox="0 0 24 24"><path d="M21 2H3a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h7v2H8v2h8v-2h-2v-2h7a2 2 0 0 0 2-2V4a2 2 0 0 0-2-2zm0 7h-7v2h7v5H3v-5h5v3l4-4l-4-4v3H3V4h18z" fill="currentColor"/></svg>
                </button>
                
            </a>
        </div>
