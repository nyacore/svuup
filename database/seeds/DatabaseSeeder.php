<?php

use App\Models\Lead;
use App\Models\Role;
use App\Models\Task;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        (new Role([
            'name' => 'Администратор',
            'stub' => 'admin'
        ]))->save();

        (new Role([
            'name' => 'Преподаватель',
            'stub' => 'teacher'
        ]))->save();

        (new Role([
            'name' => 'Студент',
            'stub' => 'student'
        ]))->save();

        (new User([
            'name' => 'Администратор',
            'password' => Hash::make('secret'),
            'role_id' => Role::where('stub', 'admin')->first()->id,
            'email' => 'bjadmund@mail.ru'
        ]))->save();
    }
}
