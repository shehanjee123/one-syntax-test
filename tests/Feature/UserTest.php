<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;


class UserTest extends TestCase
{

    use RefreshDatabase;
    /**
     * @test
     */
    public function user_should_have_valid_data(){
        $this->withoutExceptionHandling();

      $response = $this->post(Route('user.details',[
        'email' => 'user@mail.com',
      ]));

       $response->assertOk();
    }
}
