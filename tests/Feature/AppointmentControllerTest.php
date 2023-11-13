<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Doctor;
use App\Models\Appointment;
use App\Models\Prescription;

class AppointmentControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_can_get_appointments_for_admin()
    {
        $adminUser = User::factory()->create(['role' => 1]);
        $response = $this->actingAs($adminUser)->get('api/v1/appointments');

        $response->assertStatus(200);
    }

    public function test_it_can_get_appointments_for_user()
    {
        $adminUser = User::factory()->create(['role' => 0]);
        $response = $this->actingAs($adminUser)->get('api/v1/appointments');

        $response->assertStatus(200);
    }

    public function test_it_can_create_appointment()
    {
        $user = User::factory()->create();
        $doctor = Doctor::factory()->create();

        $response = $this->actingAs($user)->postJson('api/v1/appointment', [
            'doctor_id' => $doctor->id,
            'user_id' => $user->id,
            'payment_type_id' => 1, 
            'note' => 'This is a test appointment',
            'appointment_date' => '01-12-2023',
        ]);

        $response->assertStatus(201);
        $response->assertSee('appointment_date');
        $response->assertSee('status');
    }


}
