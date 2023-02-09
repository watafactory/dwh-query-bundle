<?php

declare(strict_types=1);

namespace Wata\DwhQueryBundle\Resolver;

use GraphQL\Type\Definition\ResolveInfo;

class ResolverMapBuilder implements ResolverMapBuilderInterface
{
    private ResolverExecutor $resolverExecutor;
    private array $resolvers;

    public function __construct(ResolverExecutor $resolverExecutor)
    {
        $this->resolverExecutor = $resolverExecutor;
        $this->resolvers = [];
    }

    public function addResolver(QueryResolverInterface $queryResolver): void
    {
        $this->addResolverForAlias($queryResolver->getAlias(), $queryResolver);
    }

    public function addResolverForAlias(string $alias, callable $queryResolver): void
    {
        $this->resolvers[$alias] =
            function (array $rootValue, array $args, ?array $context, ResolveInfo $info) use ($queryResolver) {
                return $this->resolverExecutor->execute($queryResolver, $args, $info);
            };
    }

    public function getResolverMap(): array
    {
        return $this->resolvers;
    }

}
