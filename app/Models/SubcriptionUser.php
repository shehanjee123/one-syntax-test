<?php

namespace App\Models;

use App\Models\Subscription;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubcriptionUser extends Model
{
    use HasFactory;

    protected $fillable = [
        'email',
    ];

    public function subscriptions(){
        return $this->hasOne(Subscription::class);
    }

    public function subcriptionPost(){
        return $this->hasOne(PostSubscription::class);
    }

}
