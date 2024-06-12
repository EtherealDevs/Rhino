<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Kreait\Firebase\Factory;
use Kreait\Firebase\ServiceAccount;

class FirebaseServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('firebase', function ($app) {
            $config = $app['config']['services.firebase'];

            // Create a ServiceAccount object from the credentials file path
            $serviceAccount = ServiceAccount::fromJsonFile($config['credentials']);

            // Initialize the Firebase Factory
            $firebase = (new Factory)
                ->withServiceAccount($serviceAccount)
                ->create();

            return $firebase;
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
