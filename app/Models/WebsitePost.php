<?php

namespace App\Models;

use App\Models\Website;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WebsitePost extends Model
{
    use HasFactory;

    protected $fillable = [
        'post_title',
        'post_description',
        'website_id',
        'is_publish',
    ];

    public function website()
    {
        return $this->belongsTo(Website::class);
    }

    public function postSubscriptions(){
        return $this->hasOne(PostSubscription::class);
    }
}
