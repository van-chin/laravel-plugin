<?php

namespace VanLaravelPlugin\Tests\Commands;

use Illuminate\Support\Facades\Event;
use VanLaravelPlugin\Contracts\RepositoryInterface;
use VanLaravelPlugin\Support\Plugin;
use VanLaravelPlugin\Tests\TestCase;

class DisableCommandTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();
        $this->artisan('plugin:make', ['name' => ['Blog']]);
        $this->artisan('plugin:make', ['name' => ['Taxonomy']]);
    }

    public function tearDown(): void
    {
        $this->app[RepositoryInterface::class]->delete('Blog');
        $this->app[RepositoryInterface::class]->delete('Taxonomy');
        parent::tearDown();
    }

    public function test_it_disables_a_plugin()
    {
        Event::fake();
        /** @var Plugin $blogPlugin */
        $blogPlugin = $this->app[RepositoryInterface::class]->find('Blog');
        $blogPlugin->enable();

        $code = $this->artisan('plugin:disable', ['plugin' => 'Blog']);

        $this->assertTrue($blogPlugin->isDisabled());
        $this->assertSame(0, $code);
        Event::assertDispatched('plugins.disabling');
        Event::assertDispatched('plugins.disabled');
    }

    public function it_disables_all_plugins()
    {
        Event::fake();
        /** @var Plugin $blogModule */
        $blogPlugin = $this->app[RepositoryInterface::class]->find('Blog');
        $blogPlugin->enable();

        /** @var Plugin $taxonomyPlugin */
        $taxonomyPlugin = $this->app[RepositoryInterface::class]->find('Taxonomy');
        $taxonomyPlugin->enable();

        $code = $this->artisan('plugin:enable');

        $this->assertTrue($blogModule->isDisabled() && $taxonomyPlugin->isDisabled());
        $this->assertSame(0, $code);
        Event::assertDispatched('plugins.disabling');
        Event::assertDispatched('plugins.disabled');
    }
}
