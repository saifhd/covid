<?php

namespace Database\Seeders;

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
        \App\Models\User::factory(10)->create();

        User::all()->each(function($user){
            \App\Models\HelpAndGuid::factory(10)->create([
                'user_id' => $user->id
            ]);
        });
    }
}
