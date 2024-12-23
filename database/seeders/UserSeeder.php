<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        User::factory(1)->admin()->create();
        User::factory(1)->user()->hasApplications(35)->create();
        User::factory(3)->hasApplications(35)->create();
    }
}
