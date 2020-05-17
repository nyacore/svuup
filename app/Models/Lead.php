<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Models\Phone;
use App\Models\Call;

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

    public function tasks()
    {
        return $this->hasMany(Task::class);
    }

    public function phones()
    {
        return $this->hasOne(Phone::class);
    }

    public function calls()
    {
        return $this->hasMany(Call::class);
    }
}
