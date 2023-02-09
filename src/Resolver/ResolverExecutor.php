<?php

declare(strict_types=1);

namespace Wata\DwhQueryBundle\Resolver;

use GraphQL\Type\Definition\ResolveInfo;

class ResolverExecutor
{
    private iterable $preInterceptors;
    private iterable $transformers;

    /**
     * @param iterable $preInterceptors
     * @param iterable $transformers
     */
    public function __construct(iterable $preInterceptors, iterable $transformers)
    {
        $this->preInterceptors = $preInterceptors;
        $this->transformers = $transformers;
    }

    public function execute(callable $queryResolver, array $args, ResolveInfo $info)
    {
        $preparedArgs = $this->parseArgs($args);
        $preparedArgs[] = $info;
        $this->executePreInterceptors($preparedArgs);
        $result = $queryResolver(...$preparedArgs);
        $result = $this->executeTransformers($result);
        return $result;
    }

    private function executePreInterceptors(array &$args): void
    {
        foreach ($this->preInterceptors as $preInterceptor) {
            $preInterceptor(...$args);
        }
    }

    private function executeTransformers($result)
    {
        foreach ($this->transformers as $transformer) {
            $result = $transformer($result);
        }

        return $result;
    }

    private function parseArgs(array $args): array
    {
        $arguments = [];
        $arguments[0] = $args['where'] ?? [];
        $arguments[1] = $args['orderBy'] ?? [];
        $arguments[2] = $args['groupBy'] ?? [];
        $arguments[3] = $args;

        return $arguments;
    }
}
