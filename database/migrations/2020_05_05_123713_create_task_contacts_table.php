<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTaskContactsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('task_contacts', function (Blueprint $table) {
            $table->id();
            $table->string('contact_id'); // ID родительского контакта
            $table->dateTime('date'); // Дата
            $table->string('type'); // Тип
            $table->string('contact');
            $table->string('performer'); // Исполниетель
            $table->text('comment'); // Комментарий
            $table->boolean('autorun');
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
        Schema::dropIfExists('task_contacts');
    }
}
