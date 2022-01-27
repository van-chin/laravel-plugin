<?php

namespace Van\LaravelPlugin\Tests;

use Orchestra\Testbench\TestCase as Orchestra;
use Van\LaravelPlugin\Providers\PluginServiceProvider;

abstract class TestCase extends Orchestra
{
    protected function setUp(): void
    {
        parent::setUp();
        if (method_exists($this, 'withoutMockingConsoleOutput')) {
            $this->withoutMockingConsoleOutput();
        }
    }

    private function resetDatabase()
    {
        $this->artisan('migrate:reset', [
            '--database' => 'sqlite',
        ]);
    }

    public function getEnvironmentSetup($app)
    {
        $app['config']->set('database.default', 'sqlite');
        $app['config']->set('database.connections.sqlite', [
            'driver'   => 'sqlite',
            'database' => ':memory:',
            'prefix'   => '',
        ]);
    }

    protected function getPackageProviders($app)
    {
        return [
            PluginServiceProvider::class,
        ];
    }

    protected function setUpDatabase()
    {
        $this->resetDatabase();
    }
}
