<?php

namespace VanLaravelPlugin\Tests\Commands;

use Illuminate\Filesystem\Filesystem;
use VanLaravelPlugin\Contracts\RepositoryInterface;
use VanLaravelPlugin\Tests\TestCase;

class RouteProviderMakeCommandTest extends TestCase
{
    /**
     * @var Filesystem
     */
    private Filesystem $finder;
    /**
     * @var string
     */
    private string $pluginPath;

    public function setUp(): void
    {
        parent::setUp();
        $this->pluginPath = base_path('plugins/Blog');
        $this->finder = $this->app['files'];
        $this->artisan('plugin:make', ['name' => ['Blog']]);
    }

    public function tearDown(): void
    {
        $this->app[RepositoryInterface::class]->delete('Blog');
        parent::tearDown();
    }

    public function it_generates_a_new_service_provider_class()
    {
        $path = $this->pluginPath.'/Providers/RouteServiceProvider.php';
        $this->finder->delete($path);
        $code = $this->artisan('plugin:route-provider', ['plugin' => 'Blog']);

        $this->assertTrue(is_file($path));
        $this->assertSame(0, $code);
    }
}
