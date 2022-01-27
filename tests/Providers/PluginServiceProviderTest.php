<?php

namespace Van\LaravelPlugin\Tests\Providers;

use Van\LaravelPlugin\Contracts\ActivatorInterface;
use Van\LaravelPlugin\Contracts\RepositoryInterface;
use Van\LaravelPlugin\Exceptions\InvalidActivatorClass;
use Van\LaravelPlugin\Tests\TestCase;

class PluginServiceProviderTest extends TestCase
{
    public function test_it_binds_plugins_key_to_repository_class()
    {
        $this->assertInstanceOf(RepositoryInterface::class, app(RepositoryInterface::class));
        $this->assertInstanceOf(RepositoryInterface::class, app('plugins.repository'));
    }

    public function test_binds_activator_to_activator_class()
    {
        $this->assertInstanceOf(ActivatorInterface::class, app(ActivatorInterface::class));
        $this->assertInstanceOf(ActivatorInterface::class, app('plugins.activator'));
    }

    public function test_it_throws_exception_if_config_is_invalid()
    {
        $this->expectException(InvalidActivatorClass::class);
        $this->app['config']->set('plugins.activators.file', ['class' => null]);
        $this->assertInstanceOf(ActivatorInterface::class, app(ActivatorInterface::class));
    }
}
