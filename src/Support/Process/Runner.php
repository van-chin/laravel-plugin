<?php

namespace VanLaravelPlugin\Support\Process;

use VanLaravelPlugin\Contracts\RepositoryInterface;
use VanLaravelPlugin\Contracts\RunableInterface;

class Runner implements RunableInterface
{
    /**.
     * @var RepositoryInterface
     */
    protected RepositoryInterface $repository;

    public function __construct(RepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Run the given command.
     *
     * @param  string  $command
     */
    public function run(string $command)
    {
        passthru($command);
    }
}
