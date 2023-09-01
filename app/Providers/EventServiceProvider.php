<?php

namespace App\Providers;

use App\Models\JobOrderActual;
use App\Models\Material;
use App\Models\MaterialType;
use App\Models\Purchase;
use App\Models\PurchaseDetail;
use App\Observers\JobOrderActualObserver;
use App\Observers\MaterialObserver;
use App\Observers\MaterialTypeObserver;
use App\Observers\PurchaseDetailObserver;
use App\Observers\PurchaseObserver;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event to listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        JobOrderActual::observe(JobOrderActualObserver::class);
        PurchaseDetail::observe(PurchaseDetailObserver::class);
        Material::observe(MaterialObserver::class);
        MaterialType::observe(MaterialTypeObserver::class);
        Purchase::observe(PurchaseObserver::class);
    }

    /**
     * Determine if events and listeners should be automatically discovered.
     *
     * @return bool
     */
    public function shouldDiscoverEvents()
    {
        return false;
    }
}
