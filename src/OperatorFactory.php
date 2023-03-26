<?php

namespace Bermuda\Flysystem;

use League\Flysystem\Filesystem;
use League\Flysystem\Local\LocalFilesystemAdapter;

final class OperatorFactory
{
    public function __invoke(): Filesystem
    {
        return new Filesystem(new LocalFilesystemAdapter(getcwd()));
    }
}
