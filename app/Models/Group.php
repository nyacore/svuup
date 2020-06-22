<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    protected $with = ['speciality'];

    protected $fillable = ['name', 'speciality_id'];

    public function speciality()
    {
        return $this->belongsTo(Speciality::class);
    }

    public function users()
    {
        return $this->hasMany(User::class);
    }
}
