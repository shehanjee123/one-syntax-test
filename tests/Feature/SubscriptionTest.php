<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class SubscriptionTest extends TestCase
{

    use RefreshDatabase;

    /**
     * @test
     */
    public function subcription_user_testing(){

        $this->withoutExceptionHandling();

        $response = $this->postJson(Route('subscription.make',[
            'email' => 'sjeewantha9971@gmail.com',
            'website_id' => '2',
        ]));

        $response->assertOk();
    }
}
