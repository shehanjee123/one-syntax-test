<?php

namespace Tests\Feature;

use App\Http\Requests\WebSitePostRequest;
use App\Models\Website;
use App\Models\WebsitePost;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
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

    public function provideWebsiteData(){
        return[
            ['result'=>false,[],'message'=>'Should have Title,Description,Website,Published'],
            ['result'=>false,['post_title'=>'his is the Title'], 'message'=>'Should have Description,Website,Published'],
            ['result'=>false,['post_title'=>'his is the Title','post_description'=>'This is the description'], 'message'=>'Should have Website and Published'],
            ['result'=>false,['post_title'=>'his is the Title','post_description'=>'This is the description','website_id'=>'2'],'message'=>'Should have Published'],
            ['result'=>true,['post_title'=>'his is the Title','post_description'=>'This is the description','website_id'=>'1','is_publish'=>'1'], 'message'=>'This is Valid Data'],
        ];
    }
}
