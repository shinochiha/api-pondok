<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Passport\Passport;
use App\Models\User;

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

	    $response->assertStatus(201);
	}
}
