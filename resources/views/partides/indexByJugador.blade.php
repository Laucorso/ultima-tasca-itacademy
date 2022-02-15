@extends('layouts.plantillabase')
@yield('Title', 'Partides')
@yield('content')
@can('vistaJugador')

@if(session()->has('success'))
        <div class="alert alert-success col-md-4">{{ session()->get('success') }}</div>
@endif
    <div class ="gap-8 grid grid-cols-3">
        
        <div class ="float-right">
            <form action= "{{ route('partides.store', ['id' => $jugador->id]) }}" method ="POST"> 
            @csrf
            <button type = "submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 border border-blue-700 rounded inline-flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" aria-hidden="true" role="img" width="1em" height="1em" preserveAspectRatio="xMidYMid meet" viewBox="0 0 36 36"><path class="clr-i-outline clr-i-outline-path-1" d="M15 8h9v2h-9z" fill="currentColor"/><path class="clr-i-outline clr-i-outline-path-2" d="M15 12h9v2h-9z" fill="currentColor"/><path class="clr-i-outline clr-i-outline-path-3" d="M15 16h9v2h-9z" fill="currentColor"/><path class="clr-i-outline clr-i-outline-path-4" d="M15 20h9v2h-9z" fill="currentColor"/><path class="clr-i-outline clr-i-outline-path-5" d="M15 24h9v2h-9z" fill="currentColor"/><path class="clr-i-outline clr-i-outline-path-6" d="M11 8h2v2h-2z" fill="currentColor"/><path class="clr-i-outline clr-i-outline-path-7" d="M11 12h2v2h-2z" fill="currentColor"/><path class="clr-i-outline clr-i-outline-path-8" d="M11 16h2v2h-2z" fill="currentColor"/><path class="clr-i-outline clr-i-outline-path-9" d="M11 20h2v2h-2z" fill="currentColor"/><path class="clr-i-outline clr-i-outline-path-10" d="M11 24h2v2h-2z" fill="currentColor"/><path d="M28 2H8a2 2 0 0 0-2 2v28a2 2 0 0 0 2 2h20a2 2 0 0 0 2-2V4a2 2 0 0 0-2-2zm0 30H8V4h20z" class="clr-i-outline clr-i-outline-path-11" fill="currentColor"/></svg>
                <span>Fes una nova partida</span>
            </button>
            </form>
        </div>

        <div class ="float-left">
            <a href = "{{ route('jugadors.edit', ['id' => $jugador->id]) }}">Modifica el teu nickname
                <button><svg class="h-6" fill ="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg></button>
            </a>
        </div>

        <div class ="float-left">
            <form action="{{ route('partides.destroy', ['id' =>$jugador->id]) }}" method = "POST">Elimina les partides
                @csrf
                @method('delete')
                    <button><svg class="h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg></button>
            </form>
        </div>

    </div>

    <table class = "table w-full mt-6">
        <thead>
            <tr class = "font-sans md:text-xl lg:text-3xl">
                <th class ="border border-gray-400 px-4 py-2">ID</th>
                <th class ="border border-gray-400 px-4 py-2">Dau 1</th>
                <th class ="border border-gray-400 px-4 py-2">Dau 2</th>
                <th class ="border border-gray-400 px-4 py-2">Resultat</th>
            </tr>
        </thead>
        <tbody>

            @foreach($partides as $partida)
            <tr>
                <td class ="bg bg-gray-200 border border-gray-500 px-4 py-2">{{$partida->id}}</td>
                <td class ="bg bg-gray-400 border border-gray-500 px-4 py-2">{{$partida->dau1}}</td>
                <td class ="bg bg-gray-200 border border-gray-500 px-4 py-2">{{$partida->dau2}}</td>
                <td class ="bg bg-gray-400 border border-gray-500 px-4 py-2">{{$partida->resultat}}</td>
            </tr>
            @endforeach
        </tbody>

    </table>

@endcan

                    


            
                    