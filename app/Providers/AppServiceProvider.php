<?php

namespace App\Providers;

use App\Models\User;
use App\Services\MailChimpNewsletter;
use App\Services\Newsletter;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;
use MailchimpMarketing\ApiClient;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        // Toychest
        app()->bind(Newsletter::class, function () {

            $client = (new ApiClient)->setConfig([
                'apiKey' => config('services.mailchimp.key'),
                'server' => 'us14',
            ]);

            return new MailChimpNewsletter($client);
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // Disables mass assignment by default.
        // Model::unguard();

        Gate::define('admin', function (User $user) {
            // Determine if the currently signed in user satisfies this logic
            return $user->email === 'jacko@duck.com';
        });

        // Create a custom blade directive @admin with its own logic
        Blade::if('admin', function () {
            return request()->user()?->can('admin'); // Referencing admin gate
        });
    }
}
