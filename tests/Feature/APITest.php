<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Doctor;

class APITest extends TestCase
{

    use RefreshDatabase;

    /** @test */
    public function it_can_get_a_list_of_doctors()
    {
        $response = $this->get('api/v1/doctors');
        $response->assertStatus(200);
    }

    /** @test */
    public function it_can_get_contacts()
    {
        $response = $this->getJson("api/v1/contacts");
        $response->assertStatus(200);
    }
}
