<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Speciality extends Model
{
    protected $fillable = ['name', 'faculty_id', 'semesters'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function disciplines()
    {
        return $this->belongsToMany(Discipline::class, 'speciality_discipline', 'speciality_id', 'discipline_id');
    }

    public function groups()
    {
        return $this->hasMany(Group::class);
    }
}
