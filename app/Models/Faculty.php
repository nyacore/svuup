<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Faculty extends Model
{
    protected $table = 'faculties';

    protected $fillable = ['name'];

    protected $with = ['specialities'];

    public function specialities()
    {
        return $this->hasMany(Speciality::class);
    }
}
