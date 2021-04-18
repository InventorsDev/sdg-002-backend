<?php

namespace App\Providers;

use App\Contracts\EmergencyContactRepository  as EmergencyContactRepositoryContract;
use App\Repositories\EmergencyContactRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    protected array $repositories = [
        EmergencyContactRepositoryContract::class => EmergencyContactRepository::class,
    ];

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        foreach($this->repositories as $interface => $implementation){
            $this->app->bind($interface, $implementation);
        }
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
