<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Pc;

class PcTest extends TestCase
{
	public function testsArtilcesAreDeletedCorrectly()
    {
        $pc = factory(Pc::class)->create([
			'nombre' => 'Primer Pc',
			'descripcion' => 'Descripcion',
			'costo' => 22.2
		]);
		
		$headers = [];

        $this->json('DELETE', '/api/pcs/' . $pc->id, [], $headers)
            ->assertStatus(204);
    }

	
	public function testPcsAreListedCorrectly()
	{
		factory(Pc::class)->create([
			'nombre' => 'Primer Pc',
			'descripcion' => 'Descripcion',
			'costo' => 22.2
		]);


		factory(Pc::class)->create([
			'nombre' => 'Segundo Pc',
			'descripcion' => 'Descripcion',
			'costo' => 22.2
		]);

		$headers = [];

		$response = $this->json('GET', '/api/pcs', [], $headers)
			->assertStatus(200)
			->assertJson(
		   		[ 
	   				'success' => true, 
				   	'data' => [
						['nombre' => 'Primer Pc',
						'descripcion' => 'Descripcion',
						'costo' => 22.2],
						['nombre' => 'Segundo Pc',
						'descripcion' => 'Descripcion',
						'costo' => 22.2]
					   ], 
			   		'message' => 'PCs retrieved successfully.'
			   	]);
	}
}
