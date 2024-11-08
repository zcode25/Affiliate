<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Commision extends Model
{
    protected $guarded = [];
    public $incrementing = true;

    public function affiliate()
    {
        return $this->belongsTo(Affiliate::class);
    }

    
}
