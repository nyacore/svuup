<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Thread extends Model
{
    protected $fillable = ['name', 'created_by'];

    protected $with = ['messages', 'users'];

    public function users()
    {
        return $this->belongsToMany(User::class, 'user_thread', 'thread_id', 'user_id');
    }

    public function messages()
    {
        return $this->hasMany(Message::class);
    }
}
