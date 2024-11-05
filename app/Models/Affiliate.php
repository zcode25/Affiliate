<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Affiliate extends Model
{
    protected $guarded = [];
    public $incrementing = true;

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
