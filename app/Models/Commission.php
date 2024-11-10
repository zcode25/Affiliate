<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Commission extends Model
{
    protected $guarded = [];
    public $incrementing = true;

    public function affiliate()
    {
        return $this->belongsTo(Affiliate::class);
    }

    public function project()
    {
        return $this->belongsTo(Project::class);
    }
    
}
