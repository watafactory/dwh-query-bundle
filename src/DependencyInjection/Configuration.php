<?php

declare(strict_types=1);

namespace Wata\DwhQueryBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;
use Wata\DwhQueryBundle\Resolver\FieldResolver;
use Wata\DwhQueryBundle\Schema\ManualSchemaBuilder;

class Configuration implements ConfigurationInterface
{
    public const NAME = 'dwh_query';

    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder(self::NAME);
        $rootNode = $treeBuilder->getRootNode();

        $rootNode
            ->children()
            ->scalarNode('schemas_dir')->defaultNull()->end()
            ->scalarNode('schema_builder')->defaultValue(ManualSchemaBuilder::class)->end()
            ->scalarNode('default_field_resolver')->defaultValue(FieldResolver::class)->end()
            ->end();

        return $treeBuilder;
    }

}
