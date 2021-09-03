<?php

namespace Database\Seeders;

use App\Models\Note;
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
        User::factory(1)
            ->has(Note::factory()->count(3))
            ->create(['email' => 'test1@test1.com']);

        User::factory(1)
            ->has(Note::factory()->count(2))
            ->create(['email' => 'test2@test2.com']);
    }
}
