<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Team extends Model
{
    use HasFactory;

    public function event():BelongsTo
    {
        return $this->belongsTo(Event::class);
    }

    public function user():BelongsTo
    {
        return $this->belongsTo(User::class);
    }


}   
