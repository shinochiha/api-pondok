<?php

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
        // $this->call(UsersTableSeeder::class);
        // factory(App\Models\User::class, 19)->create()->each(function ($user) {
        //     $user->profile()->save(factory(App\Models\Profile::class)->make())->each(function ($profile) {
	       //      $profile->education()->save(factory(App\Models\Education::class)->make());
	       //      $profile->family()->save(factory(App\Models\Family::class)->make());
	       //  });
        // });
        factory(App\Models\Education::class, 9)->create();
        factory(App\Models\Family::class, 9)->create();
        
    }
}
