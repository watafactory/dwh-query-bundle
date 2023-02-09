<?php

declare(strict_types=1);

namespace Wata\DwhQueryBundle\Resolver;

use GraphQL\Type\Definition\ResolveInfo;

interface QueryResolverInterface
{
    public function getAlias(): string;

    public function __invoke(array $where, array $orderBy, array $groupBy, array $args, ResolveInfo $info);
}
