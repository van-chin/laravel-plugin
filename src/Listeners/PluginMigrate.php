<?php

namespace VanLaravelPlugin\Listeners;

use Illuminate\Support\Facades\Artisan;
use VanLaravelPlugin\Support\Plugin;

class PluginMigrate
{
    public function handle(Plugin $plugin)
    {
        Artisan::call('plugin:migrate', ['plugin' => $plugin->getName()]);
    }
}
