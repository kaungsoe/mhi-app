<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;

class UserControllerTest extends TestCase
{

    use RefreshDatabase;

    public function test_it_can_create_user(){
        $user= User::factory()->create();

        $this->assertModelExists($user);
    }

    public function test_it_can_update_user_address(){
        $user= User::factory()->create();
        $address= "address 1";

        $response = $this->actingAs($user)->put('/api/v1/user', [
            'address' => $address,
        ]);

        $this->assertDatabaseHas('users', [
            'id' => $user->id,
            'address' => $address,
        ]);
    }

    public function test_it_can_update_phone_no(){
        $user=User::factory()->create();
        $phone= "09421067030";
        $response = $this->actingAs($user)->put('/api/v1/user', [
            'phone' => $phone,
        ]);

        $this->assertDatabaseHas('users', [
            'id' => $user->id,
            'phone' => $phone,
        ]);
    }

    public function test_it_can_login_user(){
        $user = User::factory()->create([
            'email' => 'johndoe@example.com',
            'password' => bcrypt('password'),
        ]);

        $response = $this->postJson('/api/v1/login', [
            'email' => 'johndoe@example.com',
            'password' => 'password',
        ]);

        $response->assertStatus(200);
        $response->assertSee("token");
    }

    public function test_it_can_register_user(){
        $response = $this->postJson('/api/v1/register', [
            'email' => 'johndoe@example.com',
            'password' => 'password',
            'name'=> 'john doe'
        ]);

        $response->assertStatus(200);
        $response->assertSee("token");
        $response->assertSee("name");
        $response->assertSee("email");
    }
}
