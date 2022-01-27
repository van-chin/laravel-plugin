<?php

namespace Van\LaravelPlugin\Tests\Support;

use Van\LaravelPlugin\Support\CompressPlugin;
use Van\LaravelPlugin\Support\Plugin;
use Van\LaravelPlugin\Tests\TestCase;

class CompressPluginTest extends TestCase
{
    private Plugin $plugin;

    public function setUp(): void
    {
        parent::setUp();
        $this->artisan('plugin:make', ['name' => ['Blog']]);
        $this->plugin = $this->app['plugins.repository']->find('Blog');
    }

    public function tearDown(): void
    {
        $this->app['files']->delete([
            $this->plugin->getCompressFilePath(),
        ]);
        $this->plugin->delete();
        parent::tearDown();
    }

    public function test_it_can_compress_succeed()
    {
        $res = (new CompressPlugin($this->plugin))->handle();
        $this->assertFileExists($this->plugin->getCompressFilePath());
        $this->assertTrue($res);
    }
}
