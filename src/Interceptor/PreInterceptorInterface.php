<?php

declare(strict_types=1);

namespace Wata\DwhQueryBundle\Interceptor;

use GraphQL\Type\Definition\ResolveInfo;

interface PreInterceptorInterface
{
    public function __invoke(array $where, array $orderBy, array $groupBy, array $args, ResolveInfo $info);
}
