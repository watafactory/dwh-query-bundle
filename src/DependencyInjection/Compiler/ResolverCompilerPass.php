<?php

declare(strict_types=1);

namespace Wata\DwhQueryBundle\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;
use Wata\DwhQueryBundle\Resolver\ResolverMapBuilder;

class ResolverCompilerPass implements CompilerPassInterface
{
    public function process(ContainerBuilder $container)
    {
        if (!$container->has(ResolverMapBuilder::class)) {
            return;
        }

        $definition = $container->findDefinition(ResolverMapBuilder::class);

        $taggedServices = $container->findTaggedServiceIds('dwh_query.query_resolver');

        foreach ($taggedServices as $id => $tags) {
            $definition->addMethodCall('addResolver', [new Reference($id)]);
        }
    }

}
