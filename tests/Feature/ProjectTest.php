<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Partida;
use App\Models\Jugador;
use App\Models\User;
use Illuminate\Support\Facades\Auth;


class ProjectTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */

    /** @test */
    public function partida_can_be_created()
    {
        $this->withoutExceptionHandling();
        $this->withoutMiddleware();
        $user = User::factory(1)->create()->each(function($user){
            $jugador = Jugador::factory()->create([
                'user_id'=>$user->id
                ]); 
            });
        $jugador = Jugador::all();

        $response = $this->post('api/players/{$jugador->id}/games', [
            'dau1' => 6,
            'dau2' => 4,
            'resultat' => 0,
            'jugador_id' => $jugador[0]->id,
        ]);
        $response -> assertOk();
        $this->assertCount(1, Partida::all()); //almenys hi ha d'haver una partida
        $partida = Partida::first();
        $this->assertEquals($partida->dau1, 6); //comparem valors del dau
        $this->assertEquals($partida->dau2, 4); //comparem valors 
        $this->assertEquals($partida->resultat, 0); //comparem valors
        $this->assertEquals($partida->jugador_id, $jugador[0]->id); //comparem valors


        $response->assertRedirect('partides.indexByJugador', $jugador);
    }
    /** @test */
    public function partides_by_jugador_can_be_retrieved()
    {
        $this->withoutExceptionHandling();
        $this->withoutMiddleware();
        $user = User::factory(1)->create()->each(function($user){
            $jugador = Jugador::factory()->create([
                'user_id'=>$user->id
                ]); 
            $partida = Partida::factory(5)->create([
                'jugador_id' => $jugador->id
                ]);

            });
        
        $response = $this->get('api/players/{$jugador->id}/games');
        $response ->assertOk();
        $partides = Partida::all(); //del user id determinat
        $response ->assertViewIs('partides.indexByJugador');
        $response ->assertViewHas('partides', $partides); //comparant 

    }
    /** @test */
    public function jugadors_list_can_be_retrieved()
    {
        $this->withoutExceptionHandling();
        $this->withoutMiddleware();
        
        $user = User::factory(2)->create()->each(function($user){
        $jugadors = Jugador::factory()->create([
            'user_id'=>$user->id
            ]); 
        });

        $response = $this->get('api/players');
        $response ->assertOk();
        $jugadors = Jugador::all();
        //compararem valors a la vista després de agafar tots els jugadors
        $response ->assertViewIs('jugadors.llistatJugadors'); //vista q ens ha de retornar
        $response ->assertViewHas('jugadors', $jugadors);
    }
    
    /** @test */
    public function nickname_can_be_updated()
    {
        $this->withoutExceptionHandling();
        $this->withoutMiddleware();

        $user = User::factory(1)->create()->each(function($user){
            $jugador = Jugador::factory()->create([
                'user_id'=>$user->id
                ]); 
            });
        $jugador = Jugador::all();

        $response = $this ->put('api/players/{$jugador->id}', [ //volem id del primer i unic element d larray
            
            'nickname' => 'Nickname modificat'

        ]); 
        $jugador = Jugador::findOrFail($jugador[0]->id); //jugador q ha d tenir la info modificada
        $this ->assertEquals($jugador ->nickname, 'Nickname modificat'); //info ha de ser igual a la q hem introduit
        $response ->assertRedirect('/players/{$jugador[0]->id}'); //si tot està ok ens retornarà aquesta vista
        
    }
    
    /** @test */
    public function partides_can_be_deleted()
    {
        $this->withoutExceptionHandling();
        $this->withoutMiddleware();
        
        $user = User::factory(1)->create()->each(function($user){
            $jugador = Jugador::factory()->create([
                'user_id'=>$user->id
                ]); 
            $partides = Partida::factory()->create([
                'jugador_id' =>$jugador->id
                ]);
        });
        
        $partides = Partida::all();
        $response = $this->delete('/players/{$jugador->id}/games');
        $this->assertCount(0, $partides); //el recompte ha de ser 0 després d'eliminar
        $response ->assertRedirect('/players/games'.$jugador->id); //si coincideix farà redireccio
    }
    
    /**@test */
    /*public function nickname_required(){
        $this->withoutMiddleware();

        $jugador = Jugador::factory(1)->create();  
        //falla pq si anem als seeders veiem q m'haig de crear usuaris per crear jugador (user_id)
        $response = $this->post('api/players/'.$jugador,[
            'nickname' =>"",
        ]);
        $response ->assertSessionHasErrors(['nickname']);

    }*/
    


}
