<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Partida;
use App\Models\Jugador;
use App\Models\User;

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
        $response = $this->post('', [
            'dau1' => 6,
            'dau2' => 4,
            'resultat' => 0,
            'jugador_id' => 3,

        ]);
        $response -> assertOk();
        $this->assertCount(1, Partida::all()); //almenys hi ha d'haver una partida
        $partida = Partida::first();
        $this->assertEquals($partida->dau1, 6); //comparem valors del dau
        $this->assertEquals($partida->dau2, 4); //comparem valors 
        $this->assertEquals($partida->resultat, 0); //comparem valors


        $response->assertRedirect('partides.indexByJugador');
    }
    /**@test */
    public function partides_list_can_be_retrieved()
    {
        $this->withoutExceptionHandling();
        $response = $this->get('');
        $response ->assertOk();
        $partides = Partida::all();

        $response ->assertViewIs('partides.indexByJugador');
        $response ->assertViewHas('partides', $partides);

    }
    /**@test */
    public function jugadors_list_can_be_retrieved()
    {
        $this->withoutExceptionHandling();
        $response = $this->get('');
        $response ->assertOk();
        $jugadors = Jugador::all();
        //compararem valors a la vista després de agafar tots els jugadors
        $response ->assertViewIs('jugadors.llistatJugadors'); //vista q ens ha de retornar
        $response ->assertViewHas('jugadors', $jugadors);
    }
    
    /**@test */
    public function nickname_can_be_updated()
    {
        $this->withoutExceptionHandling();
        $jugador = Jugador::factory(1)->create();

        $response = $this ->put('/players/{$jugador[0]->id}', [ //volem id del primer i unic element d larray
                                                                //segon parametre es la info q volem modificar
            'nickname' => 'Nickname modificat'

        ]); 
        $jugador = Jugador::findOrFail($jugador[0]->id); //jugador q ha d tenir la info modificada
        $this ->assertEquals($jugador ->nickname, 'Nickname modificat'); //info ha de ser igual a la q hem introduit
        $response ->assertRedirect('/players/{$players[0]->id}'); //si tot està ok ens retornarà aquesta vista
        
    }
    
    /**@test */
    public function partides_can_be_deleted()
    {
        $this->withoutExceptionHandling();
        $jugador = User::Auth()->jugador;
        $partides = $jugador->partidas;
        $response = $this->delete('/players/{$jugador->id}/games');
        $this->assertCount(0, $partides); //el recompte ha de ser 0 després d'eliminar
        $response ->assertRedirect('/players/{$jugador->id}/games'); //si coincideix farà redireccio
    }
    
    //fer tmb testing de les validations
}
