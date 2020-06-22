<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Discipline extends Model
{
    protected $fillable = ['name', 'user_id', 'speciality_id', 'semester'];

    protected $with = ['user', 'events'];

    public function specialities()
    {
        return $this->belongsToMany(Speciality::class, 'speciality_discipline', 'discipline_id', 'speciality_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function events()
    {
        return $this->hasMany(Event::class);
    }
}
