<?php

namespace Tests\Feature;

use App\Jobs\SendMailJob;
use App\Models\PostSubscription;
use App\Models\Subscription;
use App\Models\WebsitePost;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Queue;
use Tests\TestCase;

class ResendEmailTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function it_resends_emails_only_to_users_who_did_not_receive_them()
    {
        Queue::fake();

        $post = WebsitePost::factory()->create();

        $subscribers = Subscription::factory()->count(3)->create([
            'website_id' => $post->website_id,
        ]);

        $alreadyReceivedUser = $subscribers->first();
        PostSubscription::create([
            'post_id' => $post->id,
            'user_id' => $alreadyReceivedUser->user_id
        ]);

        $response = $this->postJson(route('sendMail'), [
            'post_id' => $post->id
        ]);

        $response->assertOk();
        $response->assertJson(['message' => 'Emails resent to users who did not receive them previously.']);

        Queue::assertPushed(SendMailJob::class, function ($job) use ($alreadyReceivedUser) {
            return $job->user_id !== $alreadyReceivedUser->user_id;
        });

        Queue::assertPushed(SendMailJob::class, 2);
    }
}
