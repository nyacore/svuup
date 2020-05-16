<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Models\Lead;

class Task extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = [
        'lead_id', // ID родительского контакта
        'date', // Дата
        'type', // Тип
        'contact', // Контакт
        'performer', // Исполниетель
        'comment', // Комментарий
        'autorun', // Автозапуск
    ];

    protected $with = ['user'];


    protected $table = 'tasks';

    public function lead()
    {
        return $this->belongsTo(Lead::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
