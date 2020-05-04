<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLeadsContact extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('leads_contact', function (Blueprint $table) { 
            $table->id(); 
            $table->string('name'); // Имя
            $table->string('phones')->unique(); // Телефоны 
            $table->string('emails')->unique(); // Электронные почты
            $table->string('sites'); // Сайты
            $table->string('city'); // Город
            $table->string('street'); // Улица
            $table->string('region'); // Район
            $table->string('activity'); // Сфера деятельности
            $table->string('INN')->unique(); // Идентификационный номер налогоплательщика
            $table->string('KPP')->unique(); // Код причины постановки на учет.
            $table->string('tags'); // Тэги
            $table->text('desc'); // Описание
            $table->string('responsible'); // Ответсвенное лицо
            $table->boolean('main')->default(false); // Главный контакт
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
