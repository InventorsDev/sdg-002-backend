<?php

namespace App\Providers;

use App\Repositories\UserRepository;
use Illuminate\Support\ServiceProvider;
use App\Repositories\MedicationRepository;
use App\Repositories\EmergencyContactRepository;
use App\Contracts\UserRepository as UserRepositoryContract;
use App\Contracts\MedicationRepository as MedicationRepositoryContract;
use App\Contracts\EmergencyContactRepository  as EmergencyContactRepositoryContract;

class RepositoryServiceProvider extends ServiceProvider
{
    protected array $repositories = [
        EmergencyContactRepositoryContract::class => EmergencyContactRepository::class,
        UserRepositoryContract::class => UserRepository::class,
        MedicationRepositoryContract::class => MedicationRepository::class,
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
