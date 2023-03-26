<?php

namespace Bermuda\Flysystem;

use League\Flysystem\FilesystemOperator;

final class ConfigProvider extends Bermuda\Config\ConfigProvider
{
    /**
     * @inheritDoc
     */
    protected function getFactories(): array
    {
        return [
            FilesystemOperator::class => static fn() => OperatorFactory::class
        ];
    }
}
