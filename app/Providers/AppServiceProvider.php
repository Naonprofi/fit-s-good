<?php

namespace App\Providers;

use App\Models\Category;
use App\Models\CustContact;
use App\Models\CustData;
use App\Models\CustMembership;
use App\Models\Customer;
use App\Models\Food;
use App\Models\Reservation;
use App\Models\Worker;
use App\Models\WorkerContact;
use App\Models\WorkerData;
use App\Models\WorkerJobTitle;
use App\Models\WorkerSchedule;
use App\Policies\CategoryPolicy;
use App\Policies\CustContactPolicy;
use App\Policies\CustDataPolicy;
use App\Policies\CustMembershipPolicy;
use App\Policies\CustomerPolicy;
use App\Policies\FoodPolicy;
use App\Policies\ReservationPolicy;
use App\Policies\WorkerContactPolicy;
use App\Policies\WorkerDataPolicy;
use App\Policies\WorkerJobTitlePolicy;
use App\Policies\WorkerPolicy;
use App\Policies\WorkerSchedulePolicy;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Gate::policy(Food::class, FoodPolicy::class);
        Gate::policy(Category::class, CategoryPolicy::class);
        Gate::policy(Customer::class, CustomerPolicy::class);
        Gate::policy(CustContact::class, CustContactPolicy::class);
        Gate::policy(CustData::class, CustDataPolicy::class);
        Gate::policy(CustMembership::class, CustMembershipPolicy::class);
        Gate::policy(Reservation::class, ReservationPolicy::class);
        Gate::policy(Worker::class, WorkerPolicy::class);
        Gate::policy(WorkerContact::class, WorkerContactPolicy::class);
        Gate::policy(WorkerData::class, WorkerDataPolicy::class);
        Gate::policy(WorkerJobTitle::class, WorkerJobTitlePolicy::class);
        Gate::policy(WorkerSchedule::class, WorkerSchedulePolicy::class);
    }
}
