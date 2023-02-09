<?php

declare(strict_types=1);

namespace Wata\DwhQueryBundle\Executor;

use GraphQL\GraphQL;
use Wata\DwhQueryBundle\Resolver\ResolverMapBuilderInterface;
use Wata\DwhQueryBundle\Schema\SchemaBuilderInterface;

class Executor implements ExecutorInterface
{
    private SchemaBuilderInterface $schemaBuilder;
    private ResolverMapBuilderInterface $resolverMapBuilder;
    /**
     * @var callable
     */
    private $defaultFieldResolver;

    /**
     * @param SchemaBuilderInterface $schemaBuilder
     * @param ResolverMapBuilderInterface $resolverMapBuilder
     * @param callable $defaultFieldResolver
     */
    public function __construct(
        SchemaBuilderInterface      $schemaBuilder,
        ResolverMapBuilderInterface $resolverMapBuilder,
        callable                    $defaultFieldResolver
    )
    {
        $this->schemaBuilder = $schemaBuilder;
        $this->resolverMapBuilder = $resolverMapBuilder;
        $this->defaultFieldResolver = $defaultFieldResolver;
    }

    public function execute(string $query): array
    {
        $schema = $this->schemaBuilder->build();
        $resolverMap = $this->resolverMapBuilder->getResolverMap();
        $input = json_decode($query, true);

        $result = GraphQL::executeQuery(
            $schema,
            $input['query'],
            $resolverMap,
            null,
            null,
            null,
            $this->defaultFieldResolver
        );

        return $result->toArray();
    }
}
