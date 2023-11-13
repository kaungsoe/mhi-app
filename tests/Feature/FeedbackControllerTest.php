<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Feedback;
use App\Models\FeedbackType;

class FeedbackControllerTest extends TestCase
{
   use RefreshDatabase;

   public function test_it_can_get_feedback_types()
   {
    $user = User::factory()->create(); 

    $response = $this->actingAs($user)->get('api/v1/getFeedbackTypes');
    $response->assertStatus(200);
   }

//    public function test_it_can_submit_feedback()
//    {
//        $user = User::factory()->create();
//        $feedbackType = FeedbackType::create([ 
//             'type' => 'General'
//        ]);

//        $response = $this->actingAs($user)->postJson('api/v1/submitFeedback', [
//            'feedback_type' => $feedbackType->id,
//            'feedback' => 'This is a test feedback',
//        ]);

//        $response->assertStatus(200);
//    }

   public function test_it_can_get_feedbacks()
   {
       $user = User::factory()->create(['role' => 1]);
       $response = $this->actingAs($user)->get('api/v1/feedbacks');

       $response->assertStatus(200);
   }

   public function test_it_cannot_get_feedbacks()
   {
       $user = User::factory()->create(['role' => 0]);
       $response = $this->actingAs($user)->get('api/v1/feedbacks');

       $response->assertStatus(401);
   }


}


