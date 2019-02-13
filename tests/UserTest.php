<?php

use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;

class UserTest extends TestCase
{
    /**
     * UserController unit-test .
     *
     * @return void
     */
    public function test_should_return_all_user()
    {
        // factory('App\Models\User',9)->create()->each(function ($user) {
        //     $user->profile()->save(factory(App\Models\Profile::class)->make()
                // ->each(function ($profile) {
                //     $profile->education()->save(factory(App\Models\Education::class)->create());
                //     $profile->family()->save(factory(App\Models\Family::class)->create());
                // })
        //     );
        //     dd($user->profile()->education());
        // });
        factory(App\Models\Education::class, 9)->create();
        factory(App\Models\Family::class, 9)->create();
       
        $this->get("/v1/users", []);
        $this->seeStatusCode(200);
        // $this->seeJson([
        //     ["data" => "attributes"],
        // ]);
        // [{"data":[{"attributes":{"email":"cbahringer@okeefe.com","username":"bbaumbach"},"id":"0ed00524-42b6-30ef-b10a-a4fb3811169a","links":{"self":"http:\/\/localhost:8000\/v1\/users\/0ed00524-42b6-30ef-b10a-a4fb3811169a"},"relationships":{"profile":{"links":{"related":"http:\/\/localhost:8000\/v1\/users\/0ed00524-42b6-30ef-b10a-a4fb3811169a\/profile"}}},"type":"users"}]
        // }];
    }
}
