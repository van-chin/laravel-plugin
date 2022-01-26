<?php

namespace VanLaravelPlugin\Providers;

use Carbon\Laravel\ServiceProvider;
use Illuminate\Support\Str;
use VanLaravelPlugin\Console\Commands\ComposerInstallCommand;
use VanLaravelPlugin\Console\Commands\ComposerRemoveCommand;
use VanLaravelPlugin\Console\Commands\ComposerRequireCommand;
use VanLaravelPlugin\Console\Commands\ControllerMakeCommand;
use VanLaravelPlugin\Console\Commands\DisableCommand;
use VanLaravelPlugin\Console\Commands\DownLoadCommand;
use VanLaravelPlugin\Console\Commands\EnableCommand;
use VanLaravelPlugin\Console\Commands\InstallCommand;
use VanLaravelPlugin\Console\Commands\ListCommand;
use VanLaravelPlugin\Console\Commands\LoginCommand;
use VanLaravelPlugin\Console\Commands\MigrateCommand;
use VanLaravelPlugin\Console\Commands\MigrationMakeCommand;
use VanLaravelPlugin\Console\Commands\ModelMakeCommand;
use VanLaravelPlugin\Console\Commands\PluginCommand;
use VanLaravelPlugin\Console\Commands\PluginDeleteCommand;
use VanLaravelPlugin\Console\Commands\PluginMakeCommand;
use VanLaravelPlugin\Console\Commands\ProviderMakeCommand;
use VanLaravelPlugin\Console\Commands\PublishCommand;
use VanLaravelPlugin\Console\Commands\RegisterCommand;
use VanLaravelPlugin\Console\Commands\RouteProviderMakeCommand;
use VanLaravelPlugin\Console\Commands\SeedMakeCommand;
use VanLaravelPlugin\Console\Commands\UploadCommand;

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
