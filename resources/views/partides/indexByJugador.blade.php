@extends('layouts.plantillabase')
@yield('Title', 'Partides')
@yield('content')

    <div class ="">
        <div class ="mt-6 md:w-1/2 px-3 mb-6 md:mb-0">
            <form action= "{{ route('partides.store', ['id'=>$jugador->id]) }}" method ="POST"> 
            @csrf
                <input type ="hidden" value="{{ $dau1 = 5 }}" name = 'dau1'>
                <input type ="hidden" value="{{ $dau1 = 3 }}" name = 'dau2'>
                
                <button type = "submit">Partida Nova</button>
            </form>
        </div>

        <div class ="">
            <a href = "{{ route('jugadors.edit', ['id' => $jugador->id]) }}">Canvia el teu nickname
                <button><svg class="h-6" fill ="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg></button>
            </a>
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

            <div class ="">
                <form action="{{ route('partides.destroy', ['id' =>$jugador->id]) }}" method = "POST">
                    @csrf
                    @method('delete')
                        <button><svg class="h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg></button>
                        <span>Elimina les partides</span>
                </form>
            </div>
    </table>


                    


            
                    