<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $fillable = ['name', 'discipline_id', 'max'];

    public function discipline()
    {
        return $this->belongsTo(Discipline::class);
    }

    public function marks()
    {
        return $this->hasMany(Mark::class);
    }
}
