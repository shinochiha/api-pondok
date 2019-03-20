<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Laravel\Passport\Passport;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
        Passport::tokensExpireIn(now()->addMinutes(2));
        Passport::refreshTokensExpireIn(now()->addMinutes(30));
        Passport::tokensCan([
            'read-username-email' => 'can read username and email',
            'read-basic-profile' => 'can read user\'s profile',
            'read-education-profile' => 'can read user\'s education history',
            'read-family-profile' => 'can read user\'s family profile',
            'be-trusted' => 'can browse, read, edit, add and delete data'
        ]);
        Passport::enableImplicitGrant();
        Passport::cookie('PondokIndonesia_cookie');
        Passport::routes();
    }
}
