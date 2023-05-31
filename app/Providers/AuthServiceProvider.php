<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;

use App\Models\Certifications;
use App\Models\User;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
        'App\Models\Certifications' => 'App\Policies\CertificationPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        $this->registerPolicies();
        Gate::define('isAdmin', function (User $user) {
            return $user->roles === 'Admin';
        });

        Gate::define('isDM', function (User $user) {
            return $user->roles === 'DM';
        });
    }
}
