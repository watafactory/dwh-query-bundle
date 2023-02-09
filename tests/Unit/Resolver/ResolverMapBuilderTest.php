<?php

declare(strict_types=1);

namespace Wata\DwhQueryBundle\Tests\Unit\Resolver;

use GraphQL\Type\Definition\ResolveInfo;
use PHPUnit\Framework\TestCase;
use Wata\DwhQueryBundle\Resolver\QueryResolverInterface;
use Wata\DwhQueryBundle\Resolver\ResolverExecutor;
use Wata\DwhQueryBundle\Resolver\ResolverMapBuilder;

class ResolverMapBuilderTest extends TestCase
{
    public function testIfResolverIsAddedAndExecuted(): void
    {
        // GIVEN
        $resolverExecutor = new ResolverExecutor([]);

        $info = $this->getMockBuilder(ResolveInfo::class)
            ->disableOriginalConstructor()
            ->getMock();

        $queryResolver = $this->getMockBuilder(QueryResolverInterface::class)
            ->disableOriginalConstructor()->getMock();

        $queryResolver->expects($this->once())
            ->method('getAlias')
            ->willReturn('testQuery');

        $queryResolver->expects($this->once())
            ->method('__invoke')
            ->willReturn(['data' => 1]);

        // WHEN
        $resolverMapBuilder = new ResolverMapBuilder($resolverExecutor);
        $resolverMapBuilder->addResolver($queryResolver);
        $allResolvers = $resolverMapBuilder->getResolverMap();
        $result = $allResolvers['testQuery']([], [], [], $info);

        // THEN
        $this->assertEquals(1, $result['data']);
    }
}
