<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNullableToTasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tasks', function (Blueprint $table) {
            $table->string('lead_id')->nullable()->change(); // ID родительского контакта
            $table->integer('user_id')->nullable()->change();
            $table->dateTime('date')->nullable()->change(); // Дата
            $table->string('performer')->nullable()->change(); // Исполниетель
            $table->text('comment')->nullable()->change(); // Комментарий
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tasks', function (Blueprint $table) {
            //
        });
    }
}
