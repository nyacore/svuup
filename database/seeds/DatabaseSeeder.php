<?php

use App\Models\Lead;
use App\Models\Task;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $user = User::find(1);

        $leads = factory(Lead::class, 5)->create();

        $leads->each(function ($lead) use ($user) {
            $lead->tasks()->saveMany(factory(Task::class, 5)->create([
                'lead_id' => $lead->id,
                'contact' => $lead->name,
                'performer' => $user->name
            ]));
        });
    }
}
