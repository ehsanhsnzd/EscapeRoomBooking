<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

/**
 * Class RepositoryServiceProvider
 * @package App\Providers
 */
class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * @return void
     */
    public function register(): void
    {
        $this->app->bind(
            'Domain\User\Repositories\UserRepositoryInterface',
            'Domain\User\Repositories\UserRepository'
        );

        $this->app->bind(
            'Domain\Booking\Repositories\BookingRepositoryInterface',
            'Domain\Booking\Repositories\BookingRepository'
        );

        $this->app->bind(
            'Domain\Room\Repositories\RoomRepositoryInterface',
            'Domain\Room\Repositories\RoomRepository'
        );
    }
}
