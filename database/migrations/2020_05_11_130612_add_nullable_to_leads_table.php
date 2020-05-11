<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNullableToLeadsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('leads', function (Blueprint $table) {
            $table->string('phones')->nullable()->change(); // Телефоны
            $table->string('emails')->nullable()->change(); // Электронные почты
            $table->string('sites')->nullable()->change(); // Сайты
            $table->string('city')->nullable()->change(); // Город
            $table->string('street')->nullable()->change(); // Улица
            $table->string('region')->nullable()->change(); // Район
            $table->string('activity')->nullable()->change(); // Сфера деятельности
            $table->string('INN')->nullable()->change(); // Идентификационный номер налогоплательщика
            $table->string('KPP')->nullable()->change(); // Код причины постановки на учет.
            $table->string('tags')->nullable()->change(); // Тэги
            $table->text('desc')->nullable()->change(); // Описание
            $table->string('responsible')->nullable()->change(); // Ответсвенное лицо
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('leads', function (Blueprint $table) {
            //
        });
    }
}
