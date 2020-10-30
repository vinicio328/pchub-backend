<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Pc;

class PcTest extends TestCase
{
	public function testPcIsDeletedCorrectly()
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

	public function testPcISCreatedCorrectly()
	{        
		$headers = [];
		$payload = [
			'nombre' => 'Nueva PC',
			'descripcion' => 'Nueva PC',
			'costo' => 10,
		];

		$this->json('POST', '/api/pcs', $payload, $headers)
			->assertStatus(201)
			->assertJson(
				[ 
					'success' => true, 
					'data' => 
						['nombre' => 'Nueva PC',
						'descripcion' => 'Nueva PC',
						'costo' => 10], 
					'message' => 'PC created successfully.'
				]);
	}

	public function testPcISUpdatedCorrectly()
	{
		$headers = [];
		$pc = factory(Pc::class)->create([
			'nombre' => 'Original PC',
			'descripcion' => 'Descripcion',
			'costo' => 22.2
		]);

		$payload = [
			'nombre' => 'PC Actualizada',
			'descripcion' => 'Descripcion',
			'costo' => 10
		];

		$response = $this->json('PUT', '/api/pcs/' . $pc->id, $payload, $headers)
			->assertStatus(200)
			->assertJson([ 
					'success' => true, 
					'data' => 
						['nombre' => 'PC Actualizada',
						'descripcion' => 'Descripcion',
						'costo' => 10], 
					'message' => 'PC updated successfully.'
				]);
	}

	public function testPcIsNotFound()
	{
		$headers = [];

		$response = $this->json('GET', '/api/pcs/' . 8, [], $headers)
			->assertStatus(404);
			
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
