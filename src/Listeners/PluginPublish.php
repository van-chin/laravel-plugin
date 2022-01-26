<?php

namespace VanLaravelPlugin\Listeners;

use Illuminate\Support\Facades\Artisan;
use VanLaravelPlugin\Support\Plugin;

class PluginPublish
{
    public function handle(Plugin $plugin)
    {
        Artisan::call('plugin:publish', ['plugin' => $plugin->getName()]);
    }
}
