<?php

declare(strict_types=1);

namespace Wata\DwhQueryBundle\Tests\Unit\Resolver;

use PHPUnit\Framework\TestCase;
use Wata\DwhQueryBundle\Executor\Executor;
use Wata\DwhQueryBundle\Resolver\FieldResolver;
use Wata\DwhQueryBundle\Resolver\ResolverMapBuilderInterface;
use Wata\DwhQueryBundle\Schema\ManualSchemaBuilder;

class ExecutorTest extends TestCase
{
    public function testIfExecutorIsExecuted(): void
    {
        // GIVEN
        $schemaDefinition = "
            type Query {
                test: [TestType]
            }
            type TestType {
                id: String
                name: String
            }
        ";
        $schemaBuilder = new ManualSchemaBuilder($schemaDefinition);
        $resolverMapBuilder = $this->getMockBuilder(ResolverMapBuilderInterface::class)
            ->disableOriginalConstructor()->getMock();

        // WHEN
        $executor = new Executor($schemaBuilder, $resolverMapBuilder, new FieldResolver());
        $result = $executor->execute('{"query":"{test{id,name}}"}');

        // THEN
        $this->assertNotEmpty($result['data']);
        $this->assertNull($result['data']['test']);
    }
}
