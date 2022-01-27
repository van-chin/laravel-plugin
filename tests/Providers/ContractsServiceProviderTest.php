<?php

namespace Van\LaravelPlugin\Tests\Providers;

use Van\LaravelPlugin\Contracts\RepositoryInterface;
use Van\LaravelPlugin\Support\FileRepository;
use Van\LaravelPlugin\Tests\TestCase;

class ContractsServiceProviderTest extends TestCase
{
    public function test_it_binds_repository_interface_with_implementation()
    {
        $this->assertInstanceOf(FileRepository::class, app(RepositoryInterface::class));
    }
}
