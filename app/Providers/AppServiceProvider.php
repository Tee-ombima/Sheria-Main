<?php

namespace App\Providers;

use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\ServiceProvider;
use App\Models\ApplicationSetting;
use Illuminate\Support\Facades\View;

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
        View::composer('*', function ($view) {
            $applicationSetting = ApplicationSetting::first();
            $view->with('internshipApplicationsEnabled', $applicationSetting->internship_applications_enabled);
            $view->with('pupillageApplicationsEnabled', $applicationSetting->pupillage_applications_enabled);
            $view->with('postPupillageApplicationsEnabled', $applicationSetting->post_pupillage_applications_enabled);
        });
        // Model::unguard();
        // // Set PHP upload and post size limits
        // ini_set('upload_max_filesize', '10M');
        // ini_set('post_max_size', '12M');
    }
}
