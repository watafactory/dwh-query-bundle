<?php

declare(strict_types=1);

namespace Wata\DwhQueryBundle\DependencyInjection\Compiler;

use Symfony\Component\Config\Resource\FileResource;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Finder\Finder;
use Wata\DwhQueryBundle\Schema\Loader\FileSchemaLoader;

class TypesCompilerPass implements CompilerPassInterface
{
    private const SCHEMA_FILE_EXTENSION = 'graphql';

    public function process(ContainerBuilder $container): void
    {
        $typesDefinitionPath = $container->getParameter('dwh_query.schemas_dir');

        if (null === $typesDefinitionPath) {
            return;
        }

        $files = $this->detectFilesToProcess($container, $typesDefinitionPath);
        $this->parseTypeFiles($files, $container);
    }

    private function detectFilesToProcess(ContainerBuilder $container, string $path): iterable
    {
        $resource = $path;
        while (!is_dir($resource)) {
            $resource = dirname($resource);
        }
        $container->addResource(new FileResource($resource));

        $finder = Finder::create();
        $finder->files()->in($path)->name(sprintf('*.%s', self::SCHEMA_FILE_EXTENSION));
        return $finder;
    }

    private function parseTypeFiles(iterable $files, ContainerBuilder $container): void
    {
        $fileSchemaLoader = new FileSchemaLoader();
        $configTypes = '';

        foreach ($files as $file) {
            $content = $fileSchemaLoader->loadSchema($file->getRealPath());
            $configTypes .= $content;
        }

        $container->setParameter('dwh_query.schema_config', $configTypes);
    }

}
