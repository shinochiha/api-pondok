<?php

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	// Disable foreign key checking because truncate() will fail
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');

    	User::truncate();

    	factory(User::class, 3)->create();

    	// Enable it back
        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }
}
