<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Doctor;

class DoctorControllerTest extends TestCase
{

    use RefreshDatabase;

    public function test_it_can_show_doctors(): void
    {
        $response = $this->get('api/v1/doctors');
        $response->assertStatus(200);
    }

    public function test_it_can_store_a_new_doctor()
    {
        $user = User::factory()->create(['role' => 1]); 

        $response = $this->actingAs($user)->postJson('api/v1/doctor', [
            'name' => 'John Doe',
            'degree' => 'MD',
            'biography' => 'Lorem ipsum',
            'specializationIds' => json_encode([1, 2, 3]),
        ]);

        $response->assertStatus(201);
        $response->assertSee('name');
        $response->assertSee('degree');
        $response->assertSee('biography');
    }

    public function test_it_can_get_a_specific_doctor()
    {
        $doctor = Doctor::factory()->create();

        $response = $this->get("api/v1/doctors/{$doctor->id}");

        $response->assertStatus(200);
    }

    public function test_it_can_return_error_for_invalid_doctor_id()
    {
        $doctor = Doctor::factory()->create();

        $response = $this->get("api/v1/doctors/{1}");

        $response->assertStatus(404);
    }

    public function test_it_can_update_a_doctor()
    {
        $adminUser = User::factory()->create(['role' => 1]);
        $doctor = Doctor::factory()->create();

        $response = $this->actingAs($adminUser)->putJson('api/v1/doctor', [
            'doctor_id' => $doctor->id,
            'biography' => 'Updated biography',
        ]);

        $response->assertStatus(200);
        $response->assertSee('name');
        $response->assertSee('biography');
    }

    public function test_it_can_delete_a_doctor()
    {
        $adminUser = User::factory()->create(['role' => 1]);
        $doctor = Doctor::factory()->create();

        $response = $this->actingAs($adminUser)->delete("api/v1/doctors/{$doctor->id}");

        $response->assertStatus(200);
    }

}
