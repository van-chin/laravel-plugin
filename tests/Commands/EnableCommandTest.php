<?php

namespace Van\LaravelPlugin\Tests\Commands;

use Illuminate\Support\Facades\Event;
use Van\LaravelPlugin\Contracts\RepositoryInterface;
use Van\LaravelPlugin\Support\Plugin;
use Van\LaravelPlugin\Tests\TestCase;

class EnableCommandTest extends TestCase
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

    public function test_it_enables_a_plugin()
    {
        Event::fake();
        /** @var Plugin $blogPlugin */
        $blogPlugin = $this->app[RepositoryInterface::class]->find('Blog');
        $blogPlugin->disable();

        $code = $this->artisan('plugin:enable', ['plugin' => 'Blog']);

        $this->assertTrue($blogPlugin->isEnabled());
        $this->assertSame(0, $code);
        Event::assertDispatched('plugins.enabling');
        Event::assertDispatched('plugins.enabled');
    }

    public function it_enables_all_plugins()
    {
        Event::fake();
        /** @var Plugin $blogModule */
        $blogPlugin = $this->app[RepositoryInterface::class]->find('Blog');
        $blogPlugin->disable();

        /** @var Plugin $taxonomyPlugin */
        $taxonomyPlugin = $this->app[RepositoryInterface::class]->find('Taxonomy');
        $taxonomyPlugin->disable();

        $code = $this->artisan('plugin:enable');

        $this->assertTrue($blogModule->isEnabled() && $taxonomyPlugin->isEnabled());
        $this->assertSame(0, $code);
        Event::assertDispatched('plugins.enabling');
        Event::assertDispatched('plugins.enabled');
    }
}
