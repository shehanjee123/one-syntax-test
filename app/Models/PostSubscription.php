<?php

namespace App\Models;

use App\Models\SubcriptionUser;
use App\Models\WebsitePost;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostSubscription extends Model
{
    use HasFactory;

    protected $fillable = ['post_id', 'user_id'];

    public function post()
    {
        return $this->belongsTo(WebsitePost::class);
    }

    public function user()
    {
        return $this->belongsTo(SubcriptionUser::class);
    }
}
