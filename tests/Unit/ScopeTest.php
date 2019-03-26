<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Passport\Passport;
use App\Models\User;
use App\Models\Profile;

class ScopeTest extends TestCase
{
	use RefreshDatabase;
	// protected function setUp(): void
	// protected function tearDown(): void
	
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

	public function testFailedReadingUsernameEmailWithoutRightScope()
	{
		$user = factory(User::class)->create();
	    Passport::actingAs(
	        $user,
	        ['read-basic-profile']
	    );

	    $response = $this->get('/api/v1/users/'.$user->uuid);

	    $response->assertStatus(403);
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

	public function testFailedReadingBasicProfileWithoutRightScope()
	{
		$user = factory(User::class)->create();
	    Passport::actingAs(
	        $user,
	        ['read-username-email']
	    );

	    $response = $this->get('/api/v1/users/'.$user->uuid.'/profile');

	    $response->assertStatus(403);
	}

	public function testReadingEducationProfile()
	{
		$user = factory(User::class)->create();
		$profile = $user->profile()->save(factory(Profile::class)->make());
	    Passport::actingAs(
	        $user,
	        ['read-education-profile']
	    );

	    $response = $this->get('/api/v1/profiles/'.$profile->uuid.'/education');

	    $response->assertStatus(200);
	}

	public function testFailedReadingEducationProfileWithoutRightScope()
	{
		$user = factory(User::class)->create();
		$profile = $user->profile()->save(factory(Profile::class)->make());
	    Passport::actingAs(
	        $user,
	        ['read-basic-profile']
	    );

	    $response = $this->get('/api/v1/profiles/'.$profile->uuid.'/education');

	    $response->assertStatus(403);
	}

	public function testReadingFamilyProfile()
	{
		$user = factory(User::class)->create();
		$profile = $user->profile()->save(factory(Profile::class)->make());
	    Passport::actingAs(
	        $user,
	        ['read-family-profile']
	    );

	    $response = $this->get('/api/v1/profiles/'.$profile->uuid.'/family');

	    $response->assertStatus(200);
	}

	public function testFailedReadingFamilyProfileWithoutRightScope()
	{
		$user = factory(User::class)->create();
		$profile = $user->profile()->save(factory(Profile::class)->make());
	    Passport::actingAs(
	        $user,
	        ['read-basic-profile']
	    );

	    $response = $this->get('/api/v1/profiles/'.$profile->uuid.'/family');

	    $response->assertStatus(403);
	}

    /*
    |--------------------------------------------------------------------------
    | ['be-trusted'] scope tests.
    |--------------------------------------------------------------------------
    |
	|
    |
    */
	public function testReadingUsernameEmailBeTrustedScope()
	{
		$user = factory(User::class)->create();
	    Passport::actingAs(
	        $user,
	        ['be-trusted']
	    );

	    $response = $this->get('/api/v1/users/'.$user->uuid);

	    $response->assertStatus(200);
	}

	public function testIndexUsersBeTrustedScope()
	{
		$user = factory(User::class)->create();
	    Passport::actingAs(
	        $user,
	        ['be-trusted']
	    );

	    $response = $this->get('/api/v1/users/');

	    $response->assertStatus(200);
	}

	public function testFailedIndexUsersWithoutBeTrustedScope()
	{
		$user = factory(User::class)->create();
	    Passport::actingAs(
	        $user,
	        ['read-basic-profile']
	    );

	    $response = $this->get('/api/v1/users/');

	    $response->assertStatus(403);
	}	

}
