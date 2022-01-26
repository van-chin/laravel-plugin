<?php

namespace VanLaravelPlugin\Providers;

use Carbon\Laravel\ServiceProvider;
use VanLaravelPlugin\Contracts\RepositoryInterface;
use VanLaravelPlugin\Support\FileRepository;

class ContractsServiceProvider extends ServiceProvider
{
    /**
     * Register some binding.
     */
    public function register()
    {
        $this->app->bind(RepositoryInterface::class, FileRepository::class);
    }
}
