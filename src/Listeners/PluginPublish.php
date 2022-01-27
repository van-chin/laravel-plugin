<?php

namespace Van\LaravelPlugin\Listeners;

use Illuminate\Support\Facades\Artisan;
use Van\LaravelPlugin\Support\Plugin;

class PluginPublish
{
    public function handle(Plugin $plugin)
    {
        Artisan::call('plugin:publish', ['plugin' => $plugin->getName()]);
    }
}
