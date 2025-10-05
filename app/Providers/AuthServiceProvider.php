<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use App\Models\Announcement;
use App\Policies\AnnouncementPolicy;
use App\Models\Activity;
use App\Policies\ActivityPolicy;
use App\Models\Blotter;
use App\Policies\BlotterPolicy;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        Announcement::class => AnnouncementPolicy::class,
        Activity::class => ActivityPolicy::class,
        Blotter::class => BlotterPolicy::class,
    ];

    public function boot(): void
    {
        $this->registerPolicies();
    }
}