<?php

declare(strict_types=1);

namespace App\Providers;

use App\Models\User;
use App\Models\Purchase;
use App\Models\Supplier;
use App\Models\RequestSale;
use App\Models\MasterProduct;
use App\Observers\RoleObserver;
use App\Observers\UserObserver;
use App\Models\MasterInggridient;
use Spatie\Permission\Models\Role;
use App\Observers\PurchaseObserver;
use App\Observers\SupplierObserver;
use Illuminate\Support\Facades\Event;
use App\Observers\RequestSaleObserver;
use Illuminate\Auth\Events\Registered;
use App\Observers\MasterProductObserver;
use App\Observers\MasterInggridientObserver;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
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
    public function boot(): void
    {
        User::observe(UserObserver::class);
        Supplier::observe(SupplierObserver::class);
        Role::observe(RoleObserver::class);
        MasterInggridient::observe(MasterInggridientObserver::class);
        MasterProduct::observe(MasterProductObserver::class);
        Purchase::observe(PurchaseObserver::class);
        RequestSale::observe(RequestSaleObserver::class);
    }
}
