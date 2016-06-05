<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SocialLoginProfile extends Model
{

    protected $fillable = ['facebook_id', 'google_id', 'twitter_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
