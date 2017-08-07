<?php

namespace App\Providers;

use App\Models\Venue;
use App\Policies\VenuePolicy;
use App\Models\Stipulation;
use App\Policies\StipulationPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        TItle::class => TitlePolicy::class,
        Stipulation::class => StipulationPolicy::class,
        Venue::class => VenuePolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
    }
}
