<?php

declare(strict_types=1);

namespace Wata\DwhQueryBundle\Tests\Integration\App\Resolver;

use GraphQL\Type\Definition\ResolveInfo;
use Wata\DwhQueryBundle\Resolver\QueryResolverInterface;

class TestQueryResolver implements QueryResolverInterface
{
    public function getAlias(): string
    {
        return 'test';
    }

    public function __invoke(array $where, array $orderBy, array $groupBy, array $args, ResolveInfo $info)
    {
        return [
            ['id' => 1, 'name' => 'name1'],
            ['id' => 2, 'name' => 'name2'],
            ['id' => 3, 'name' => 'name3']
        ];
    }

}
