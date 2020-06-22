<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $fillable = ['thread_id', 'text', 'from'];

    protected $with = ['from', 'attachments'];

    public function thread()
    {
        return $this->belongsTo(Thread::class);
    }

    public function from()
    {
        return $this->belongsTo(User::class, 'from');
    }

    public function attachments()
    {
        return $this->hasMany(Attachment::class);
    }
}
