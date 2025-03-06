<?php

namespace Tests\Feature;

use App\Models\SubcriptionUser;
use App\Models\Subscription;
use App\Models\Website;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class SubscriptionTest extends TestCase
{

    use RefreshDatabase;

    /**
     * @test
     */
    public function a_user_can_subscribe_to_a_website()
    {
        $this->withoutExceptionHandling();

        // Create a website
        $website = Website::factory()->create();

        // Test email
        $email = 'testuser@example.com';

        $response = $this->postJson(route('subscription.make'), [
            'email' => $email,
            'website_id' => $website->id,
        ]);

        $response->assertStatus(200)->assertJson([
            'message' => 'Subscription successful.'
        ]);

        $this->assertDatabaseHas('subscriptions', [
            'website_id' => $website->id,
            'user_id' => SubcriptionUser::where('email', $email)->first()->id
        ]);
    }

    /**
     * @test
     */
    public function a_user_cannot_subscribe_twice_to_the_same_website()
    {
        $website = Website::factory()->create();
        $user = SubcriptionUser::factory()->create(['email' => 'duplicate@example.com']);

        Subscription::create([
            'website_id' => $website->id,
            'user_id' => $user->id
        ]);

        $response = $this->postJson(route('subscription.make'), [
            'email' => $user->email,
            'website_id' => $website->id,
        ]);

        $response->assertStatus(400)->assertJson([
            'message' => 'You are already subscribed.'
        ]);
    }

    /**
     * @test
     */
    public function subscription_fails_with_invalid_data()
    {
        $response = $this->postJson(route('subscription.make'), [
            'email' => 'invalid-email', // Invalid email
            'website_id' => 99999, // Non-existing website ID
        ]);
        $response->assertStatus(422)->assertJsonValidationErrors(['email', 'website_id']);
    }
}
