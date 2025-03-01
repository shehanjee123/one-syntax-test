<?php

namespace App\Models;

use App\Models\Subscription;
use App\Models\WebsitePost;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Website extends Model{
    use HasFactory;

    protected $fillable = [
        'name',
        'url',
        'category'
    ];

    public function subscriptions(){
        return $this->hasMany(Subscription::class);
    }

    public function websitePost(){
        return $this->hasMany(WebsitePost::class);
    }

}
