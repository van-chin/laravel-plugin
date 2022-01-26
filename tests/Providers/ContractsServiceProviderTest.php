<?php

namespace VanLaravelPlugin\Tests\Providers;

use VanLaravelPlugin\Contracts\RepositoryInterface;
use VanLaravelPlugin\Support\FileRepository;
use VanLaravelPlugin\Tests\TestCase;

class ContractsServiceProviderTest extends TestCase
{
    public function test_it_binds_repository_interface_with_implementation()
    {
        $this->assertInstanceOf(FileRepository::class, app(RepositoryInterface::class));
    }
}
