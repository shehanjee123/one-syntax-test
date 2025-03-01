<?php

namespace App\Models;

use App\Models\SubcriptionUser;
use App\Models\Website;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    use HasFactory;

    protected $fillable = [
        'website_id',
        'user_id',
    ];

    public function user(){
        return $this->belongsTo(SubcriptionUser::class);
    }

    public function website(){
        return $this->belongsTo(Website::class);
    }
}
