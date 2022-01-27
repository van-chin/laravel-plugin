<?php

namespace Van\LaravelPlugin\Providers;

use Carbon\Laravel\ServiceProvider;
use Van\LaravelPlugin\Contracts\RepositoryInterface;
use Van\LaravelPlugin\Support\FileRepository;

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
