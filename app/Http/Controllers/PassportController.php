<?php

namespace App\Http\Controllers;

use App\Models\Jugador;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class PassportController extends Controller
{

    public function createLogin(){

        return view('users.login');

    }
    public function login (Request $request){
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required|min:7'

        ]);
        $data = [
            'email' => $request -> email,
            'password' => $request -> password
        ];

        if (Auth::attempt($data)){
            $token = Auth::user()->createToken('PersonalAccesClient')->accessToken;
            return response()->json(['token' => $token], 200);
            
        }else{
            return response()->json(['error' => 'Unauthorized'], 401);
        }
        $id = Auth::user()->id;
        $user = User::find($id);

        if ($user->hasRole('admin')){
            return redirect()->route('vistaAdmin');
        }else{
            return redirect()->route('vistaJugador');
        }
    
    }
    public function createRegister(){

        return view('users.register');
     
    }
    
    public function register (Request $request){

        $this ->validate($request, [
            'first_name' => 'required|min:3',
            'last_name' => 'required',
            'email' => 'required|unique|string',
            'password' => 'required|min:8',
            'nickname' => 'unique|required|min:3|string'
        ]);

        try
        {
        $user = User::create([
            'first_name' => $request -> first_name,
            'last_name' => $request -> last_name,
            'email' => $request -> email,
            'password' => bcrypt($request->password)
        ]);
        $user->assignRole('jugador');

        $jugador = Jugador::create([ 
            'nickname' => $request-> nickname
        ]); }catch(\Exception $e){
            return response()->view('errors.registererror');
        }

        $token = $user -> createToken('PersonalAccesClient')->accessToken;

        return response()-> json(['token' => $token], 200);

        return redirect()->route('dashboardJugador', $jugador);

    }
    public function logout (Request $request){
        $token = Auth::user()->token();
        $token -> revoke();

        return response()->json([
            'message' => 'Successfully logged out'
        ]);

    }
}
