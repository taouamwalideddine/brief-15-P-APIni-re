<?php

namespace App\Providers;

use App\Repositories\Eloquent\{
    CategoryRepository,
    PlantRepository,
    OrderRepository,
    UserRepository
};
use App\Repositories\Interfaces\{
    CategoryRepositoryInterface,
    PlantRepositoryInterface,
    OrderRepositoryInterface,
    UserRepositoryInterface
};
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(CategoryRepositoryInterface::class, CategoryRepository::class);
        $this->app->bind(PlantRepositoryInterface::class, PlantRepository::class);
        $this->app->bind(OrderRepositoryInterface::class, OrderRepository::class);
        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
    }
}
