<?php

namespace Van\LaravelPlugin\Providers;

use Carbon\Laravel\ServiceProvider;
use Illuminate\Support\Str;
use Van\LaravelPlugin\Console\Commands\ComposerInstallCommand;
use Van\LaravelPlugin\Console\Commands\ComposerRemoveCommand;
use Van\LaravelPlugin\Console\Commands\ComposerRequireCommand;
use Van\LaravelPlugin\Console\Commands\ControllerMakeCommand;
use Van\LaravelPlugin\Console\Commands\DisableCommand;
use Van\LaravelPlugin\Console\Commands\DownLoadCommand;
use Van\LaravelPlugin\Console\Commands\EnableCommand;
use Van\LaravelPlugin\Console\Commands\InstallCommand;
use Van\LaravelPlugin\Console\Commands\ListCommand;
use Van\LaravelPlugin\Console\Commands\LoginCommand;
use Van\LaravelPlugin\Console\Commands\MigrateCommand;
use Van\LaravelPlugin\Console\Commands\MigrationMakeCommand;
use Van\LaravelPlugin\Console\Commands\ModelMakeCommand;
use Van\LaravelPlugin\Console\Commands\PluginCommand;
use Van\LaravelPlugin\Console\Commands\PluginDeleteCommand;
use Van\LaravelPlugin\Console\Commands\PluginMakeCommand;
use Van\LaravelPlugin\Console\Commands\ProviderMakeCommand;
use Van\LaravelPlugin\Console\Commands\PublishCommand;
use Van\LaravelPlugin\Console\Commands\RegisterCommand;
use Van\LaravelPlugin\Console\Commands\RouteProviderMakeCommand;
use Van\LaravelPlugin\Console\Commands\SeedMakeCommand;
use Van\LaravelPlugin\Console\Commands\UploadCommand;

class ConsoleServiceProvider extends ServiceProvider
{
    /**
     * Namespace of the console commands.
     *
     * @var string
     */
    protected string $consoleNamespace = 'Van\LaravelPlugin\\Console\\Commands';

    /**
     * The available commands.
     *
     * @var array
     */
    protected array $commands = [
        PluginCommand::class,
        PluginMakeCommand::class,
        ProviderMakeCommand::class,
        RouteProviderMakeCommand::class,
        ControllerMakeCommand::class,
        ModelMakeCommand::class,
        MigrationMakeCommand::class,
        MigrateCommand::class,
        SeedMakeCommand::class,
        ComposerRequireCommand::class,
        ComposerRemoveCommand::class,
        ComposerInstallCommand::class,
        ListCommand::class,
        DisableCommand::class,
        EnableCommand::class,
        PluginDeleteCommand::class,
        InstallCommand::class,
        PublishCommand::class,
        RegisterCommand::class,
        LoginCommand::class,
        UploadCommand::class,
        DownLoadCommand::class,

    ];

    /**
     * @return array
     */
    private function resolveCommands(): array
    {
        $commands = [];

        foreach ((config('plugins.commands') ?: $this->commands) as $command) {
            $commands[] = Str::contains($command, $this->consoleNamespace) ?
                $command :
                $this->consoleNamespace.'\\'.$command;
        }

        return $commands;
    }

    public function register(): void
    {
        $this->commands($this->resolveCommands());
    }

    /**
     * @return array
     */
    public function provides(): array
    {
        return $this->commands;
    }
}
