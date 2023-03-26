<?php

namespace Bermuda\Flysystem;

use League\Flysystem\FilesystemOperator;

interface FilesystemAwareInterface
{
    public function setFilesystem(FilesystemOperator $filesystem): FilesystemAwareInterface ;
}
