<?php

namespace Van\LaravelPlugin\Support\Publishing;

use Van\LaravelPlugin\Support\Config\GenerateConfigReader;

class AssetPublisher extends Publisher
{
    /**
     * Determine whether the result message will shown in the console.
     *
     * @var bool
     */
    protected bool $showMessage = false;

    /**
     * Get destination path.
     *
     * @return string
     */
    public function getDestinationPath(): string
    {
        return $this->repository->assetPath($this->plugin->getLowerName());
    }

    /**
     * Get source path.
     *
     * @return string
     */
    public function getSourcePath(): string
    {
        return $this->getPlugin()->getExtraPath(
            GenerateConfigReader::read('assets')->getPath()
        );
    }
}
