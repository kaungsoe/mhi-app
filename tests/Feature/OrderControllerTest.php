<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Appointment;
use App\Models\Order;

class OrderControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_returns_404_if_order_not_found_for_completion()
    {
        $adminUser = User::factory()->create(['role' => 1]);

        $response = $this->actingAs($adminUser)->postJson('api/v1/order/complete', ['order_id' => 999]);

        $response->assertStatus(404);
    }
}
