<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mark extends Model
{
    protected $fillable = ['mark', 'event_id', 'user_id'];

    public function event()
    {
        return $this->belongsTo(Event::class);
    }
}
