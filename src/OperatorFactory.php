<?php

namespace Bermuda\Flysystem;

use League\Flysystem\Filesystem;
use League\Flysystem\FilesystemAdapter;
use League\Flysystem\Local\LocalFilesystemAdapter;
use League\Flysystem\PathNormalizer;
use League\Flysystem\UrlGeneration\PublicUrlGenerator;
use League\Flysystem\UrlGeneration\TemporaryUrlGenerator;
use Psr\Container\ContainerInterface;
use function Bermuda\Config\cget;
use function Bermuda\Config\conf;

final class OperatorFactory
{
    public function __invoke(ContainerInterface $container): Filesystem
    {
        return new Filesystem(
            $container->get(FilesystemAdapter::class),
            conf($container)[ConfigProvider::configKey][ConfigProvider::config] ?? [],
            $container->get(PathNormalizer::class),
            $container->get(PublicUrlGenerator::class),
            cget($container, TemporaryUrlGenerator::class)
        );
    }
}
