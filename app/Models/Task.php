<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

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


    protected $table = 'leads';

    // public function __construct()
    // {
    //      DB::table('tasks_contact');
    // }
}

