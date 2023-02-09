<?php

declare(strict_types=1);

namespace Wata\DwhQueryBundle\Tests\Unit\Resolver;

use GraphQL\Type\Definition\ResolveInfo;
use PHPUnit\Framework\TestCase;
use Wata\DwhQueryBundle\Resolver\ResolverExecutor;

class ResolverExecutorTest extends TestCase
{
    public function testIfResolverIsExecuted(): void
    {
        // GIVEN
        $info = $this->getMockBuilder(ResolveInfo::class)
            ->disableOriginalConstructor()
            ->getMock();

        $resolver = static function (array $where, array $orderBy, array $groupBy, array $args, ResolveInfo $info) {
            return ['data' => 1];
        };

        // WHEN
        $resolverExecutor = new ResolverExecutor([]);
        $result = $resolverExecutor->execute($resolver, [], $info);

        // THEN
        $this->assertEquals(1, $result['data']);
    }
}
