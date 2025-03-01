<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class WebsiteTest extends TestCase
{
    /**
     * @test
     */
    public function website_should_be_register_to_the_system(){
        $this->withoutExceptionHandling();

        // This is the api Route
        $response = $this->post(Route('website.register',[
            'name' => 'OneSyntax Blog',
            'category' => 'Technology',
        ]));

        $response->assertCreated();

        $this->assertDatabaseHas('websites', [
            'name' => 'OneSyntax Blog',
            'category' => 'Technology',
        ]);
    }

    /**
     * @test
     */
    public function data_should_be_requird_to_register_a_website(){
        $this->withoutExceptionHandling();

        // Pass Empty Data set to check the validation
        $response = $this->post(Route('website.register',[
            'name' => '',
            'category' => '',
        ]));

        $response->assertUnprocessable();
    }
}
