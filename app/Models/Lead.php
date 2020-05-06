<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Lead extends Model 
{
     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    
    protected $fillable = [ 
            'user_id',
            'name',
            'phones', 
            'emails',
            'sites',
            'city', // Город
            'street', // Улица
            'region', // Район
            'activity', // Сфера деятельности
            'INN', // Идентификационный номер налогоплательщика
            'KPP', // Код причины постановки на учет.
            'tags', // Тэги
            'desc', // Описание
            'responsible', // Ответсвенное лицо
            'main', // Главный контакт
    ];

    protected $table = 'leads';

    // public function __construct()
    // {
    //      DB::table('leads_contact');
    // }
}
