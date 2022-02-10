@extends('layouts.home')
@section('title', 'Edita el teu jugador')
@section('content')

<div class ="mt-6 md:w-1/2 px-3 mb-6 md:mb-0">
    <form action= "{{ route('jugadors.update', ['id'=>$jugador->id]) }}" method ="POST">
    @method('PUT')
    @csrf

            <label>
                Nickname
                <input class="w-full bg-gray-200 text-black border border-gray-200 rounded py-3 px-4" name="nickname" type="text" value="{{$jugador->nickname}}">
            </label>

            @error('nickname')
            <br>
                <strong>*{{ $message }}</strong>
            <br>
            @enderror
        
           
        <div class = "mt-2">
            <button type = "submit"  class="bg-white hover:bg-gray-100 text-green-500 font-semibold py-2 px-4 border border-gray-400 rounded shadow">Guardar</button>
        </div>
    </form>
</div>
@endsection
