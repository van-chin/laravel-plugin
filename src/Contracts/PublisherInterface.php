<?php

namespace Van\LaravelPlugin\Contracts;

interface PublisherInterface
{
    /**
     * Publish something.
     */
    public function publish(): void;
}
