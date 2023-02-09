<?php

declare(strict_types=1);

namespace Wata\DwhQueryBundle\Schema\Loader;

class FileSchemaLoader
{
    public function loadSchema(string $filePath): string
    {
        return file_get_contents($filePath);
    }
}
