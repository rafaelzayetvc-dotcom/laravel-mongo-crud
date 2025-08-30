<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Paciente;

class PacienteTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        // Confirmamos que estamos en entorno de pruebas
        $this->assertSame('testing', app()->environment());
    }

    /** @test */
    public function listar_pacientes_responde_200(): void
    {
        $response = $this->getJson('/api/pacientes');

        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'data',
                     'meta' => ['current_page', 'per_page', 'total']
                 ]);
    }

    /** @test */
    public function crear_paciente_responde_201_y_devuelve_estructura(): void
    {
        $payload = [
            'nombre' => 'Paciente Test',
            'edad' => 40,
            'email' => 'paciente.test@example.com',
            'telefono' => '555-1234',
        ];

        $response = $this->postJson('/api/pacientes', $payload);

        $response->assertStatus(201)
                 ->assertJsonStructure(['data' => [
                     'id',
                     'nombre',
                     'edad',
                     'email',
                     'telefono',
                     'created_at',
                     'updated_at',
                 ]]);

        // Limpieza: eliminamos el documento creado en la base de prueba
        $id = $response->json('data.id');
        if ($id) {
            Paciente::on('mongodb')->where('_id', $id)->delete();
        }
    }
}
