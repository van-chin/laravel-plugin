<?php

namespace Van\LaravelPlugin\Contracts;

interface RunableInterface
{
    /**
     * Run the specified command.
     *
     * @param  string  $command
     */
    public function run(string $command);
}
