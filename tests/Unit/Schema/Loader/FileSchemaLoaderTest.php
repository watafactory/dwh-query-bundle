<?php

declare(strict_types=1);

namespace Wata\DwhQueryBundle\Tests\Unit\Schema\Loader;

use PHPUnit\Framework\TestCase;
use Wata\DwhQueryBundle\Schema\Loader\FileSchemaLoader;

class FileSchemaLoaderTest extends TestCase
{
    public function testIfSchemaIsLoadedFromFile(): void
    {
        // GIVEN
        $filePath = __DIR__ . '/../../../Resources/sample_schemas/schema.graphql';

        // WHEN
        $fileSchemaLoader = new FileSchemaLoader();
        $content = $fileSchemaLoader->loadSchema($filePath);

        // THEN
        $this->assertNotEmpty($content);
    }
}
