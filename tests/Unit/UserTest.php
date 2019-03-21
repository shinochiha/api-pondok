<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Passport\Passport;
use App\Models\User;
use App\Models\Profile;

class UserTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
	public function testReadingUsernameEmail()
	{
		$user = factory(User::class)->create();
	    Passport::actingAs(
	        $user,
	        ['read-username-email']
	    );

	    $response = $this->get('/api/v1/users/'.$user->uuid);

	    $response->assertStatus(200);
	}

	public function testReadingBasicProfile()
	{
		$user = factory(User::class)->create();
	    Passport::actingAs(
	        $user,
	        ['read-basic-profile']
	    );

	    $response = $this->get('/api/v1/users/'.$user->uuid.'/profile');

	    $response->assertStatus(200);
	}

	public function testReadingEducationProfile()
	{
		$user = factory(User::class)->create();
		$profile = $user->profile()->save(factory(Profile::class)->make());
	    Passport::actingAs(
	        $user,
	        ['read-education-profile']
	    );

	    $response = $this->get('/api/v1/users/'.$user->uuid.'/profile'.$profile->uuid);
	    // dump($profile);

	    $response->assertStatus(200);
	}
// 	'be-trusted'
// 'read-basic-profile'
// 'read-education-profile'
// 'read-family-profile'
}
