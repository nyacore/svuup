<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Leads extends Model 
{
    protected $fillable = [ 
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

    public function __construct()
    {
        return DB::table('users');
    }
}
