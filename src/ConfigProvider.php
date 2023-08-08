<?php

namespace Bermuda\Flysystem;

use League\Flysystem\FilesystemAdapter;
use League\Flysystem\FilesystemOperator;
use League\Flysystem\Local\LocalFilesystemAdapter;
use League\Flysystem\PathNormalizer;
use League\Flysystem\UrlGeneration\PrefixPublicUrlGenerator;
use League\Flysystem\UrlGeneration\PublicUrlGenerator;
use League\Flysystem\UrlGeneration\ShardedPrefixPublicUrlGenerator;
use League\Flysystem\UrlGeneration\TemporaryUrlGenerator;
use League\Flysystem\WhitespacePathNormalizer;
use Psr\Container\ContainerInterface;
use function Bermuda\Config\conf;

class ConfigProvider extends \Bermuda\Config\ConfigProvider
{
    public const configKey = 'filesystem';
    public const publicUrl = 'publicUrl';
    public const config = 'config';

    /**
     * @inheritDoc
     */
    protected function getFactories(): array
    {
        return [
            FilesystemOperator::class => OperatorFactory::class,
            FilesystemAdapter::class => static fn() => new LocalFilesystemAdapter(getcwd()),
            PathNormalizer::class => static fn() => new WhitespacePathNormalizer(),
            PublicUrlGenerator::class => static function(ContainerInterface $container) {
                try {
                    $publicUrl = conf($container)[self::configKey][self::publicUrl] ?? null ;
                } catch (\Throwable) { $publicUrl = null; }

                if ($publicUrl === null) return null ;
                return is_array($publicUrl) ? new ShardedPrefixPublicUrlGenerator($publicUrl)
                    : new PrefixPublicUrlGenerator($publicUrl);
            },
        ];
    }
}
