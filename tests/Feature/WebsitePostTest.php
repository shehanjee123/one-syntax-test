<?php

namespace Tests\Feature;

use App\Http\Requests\WebSitePostRequest;
use App\Jobs\SendMailJob;
use App\Models\Subscription;
use App\Models\Website;
use App\Models\WebsitePost;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Queue;
use Illuminate\Support\Facades\Validator;
use Tests\TestCase;

class WebsitePostTest extends TestCase {

    use RefreshDatabase;

    /**
     * @test
     * @dataProvider provideWebsiteData
     * @param $result
     * @param $data
     * @param $message
     */
    public function post_should_have_valid_data_to_publish($result,$data,$message){
        $rules = (new WebSitePostRequest())->rules();
        $validate = Validator::make($data,$rules);
        $this->assertEquals($result,$validate->passes(),$message);
    }

    public static function provideWebsiteData(){
        return[
            ['result'=>false,[],'message'=>'Should have Title,Description,Website,Published'],
            ['result'=>false,['post_title'=>'his is the Title'], 'message'=>'Should have Description,Website,Published'],
            ['result'=>false,['post_title'=>'his is the Title','post_description'=>'This is the description'], 'message'=>'Should have Website and Published'],
            ['result'=>false,['post_title'=>'his is the Title','post_description'=>'This is the description','website_id'=>'2'],'message'=>'Should have Published'],
            ['result'=>true,['post_title'=>'his is the Title','post_description'=>'This is the description','website_id'=>'1','is_publish'=>'1'], 'message'=>'This is Valid Data'],
        ];
    }

    /**
     * @test
     */
     public function a_post_can_be_uploaded_and_notified_to_subscribers(){
        $this->withoutExceptionHandling();

        Queue::fake();

        // Create a test website
        $website = Website::factory()->create();

        // Create test subscribers
        $subscribers = Subscription::factory()->count(3)->create([
            'website_id' => $website->id
        ]);

        $postData = [
            'post_title' => 'Test Post Title',
            'post_description' => 'This is a test post description.',
            'website_id' => $website->id,
            'is_publish' => 1
        ];

        $response = $this->postJson(route('create.post'), $postData);

        $response->assertStatus(200)->assertJson(['message' => 'Post created and emails sent to subscribers.']);

        $this->assertDatabaseHas('website_posts', [
            'post_title' => 'Test Post Title',
            'post_description' => 'This is a test post description.',
            'website_id' => $website->id,
            'is_publish' => 1
        ]);

        // subscriptions recorded
        foreach ($subscribers as $subscriber) {
            $this->assertDatabaseHas('post_subscriptions', [
                'user_id' => $subscriber->user_id,
                'post_id' => WebsitePost::latest()->first()->id,
            ]);
        }

        //email notification jobs
        Queue::assertPushed(SendMailJob::class, 3);
     }
}
