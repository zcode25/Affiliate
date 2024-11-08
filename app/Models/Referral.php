<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Referral extends Model
{
    protected $guarded = [];
    public $incrementing = true;
    
    public function affiliate()
    {
        return $this->belongsTo(Affiliate::class);
    }

    public function referredUser()
    {
        return $this->belongsTo(User::class, 'referred_user_id');
    }
}
