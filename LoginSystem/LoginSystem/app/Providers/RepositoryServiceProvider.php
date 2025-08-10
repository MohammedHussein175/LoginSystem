<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind('App\Http\Interfaces\EmployeeRepositoryInterface',
            'App\Http\Repositories\EmployeeRepository');

        $this->app->bind('app\Http\Interfaces\AttendanceLogRepositoryInterface',
            'app\Http\Eloquent\AttendanceLogRepository');

        $this->app->bind('app\Http\Interfaces\DepartmentRepositoryInterface',
            'app\Http\Eloquent\DepartmentRepository');

        $this->app->bind('app\Http\Interfaces\LeaveRequestRepositoryInterface',
            'app\Http\Eloquent\LeaveRequestRepository');

        $this->app->bind('app\Http\Interfaces\UserRepositoryInterface',
            'app\Http\Eloquent\UserRepository');

        $this->app->bind('app\Http\Interfaces\PositionRepositoryInterface',
            'app\Http\Eloquent\PositionRepository');


    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
