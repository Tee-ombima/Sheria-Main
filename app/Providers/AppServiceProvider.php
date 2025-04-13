<?php

namespace App\Providers;

use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\ServiceProvider;
use App\Models\ApplicationSetting;
use Illuminate\Support\Facades\View;
use App\Models\User;
use App\Observers\UserObserver;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
{
    // Register the User model observer
    User::observe(UserObserver::class);

    // Existing view composer setup
    View::composer('*', function ($view) {
        $applicationSetting = ApplicationSetting::first();

        $view->with('internshipApplicationsEnabled', $applicationSetting->internship_applications_enabled);
        $view->with('pupillageApplicationsEnabled', $applicationSetting->pupillage_applications_enabled);
        $view->with('postPupillageApplicationsEnabled', $applicationSetting->post_pupillage_applications_enabled);
    });

    // Other boot logic (if any)...
}

}
