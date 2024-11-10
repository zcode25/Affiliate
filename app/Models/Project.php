<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $guarded = [];
    public $incrementing = true;
    
    public function affiliate()
    {
        return $this->belongsTo(Affiliate::class);
    }

    public function commissions()
    {
        return $this->hasMany(Commission::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
