<?php

declare(strict_types=1);

namespace Wata\DwhQueryBundle\Tests\Unit\Schema;

use GraphQL\Type\Schema;
use PHPUnit\Framework\TestCase;
use Wata\DwhQueryBundle\Schema\ManualSchemaBuilder;

class ManualSchemaBuilderTest extends TestCase
{
    public function testIfSchemaIsBuiltSuccessfully(): void
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

        // WHEN
        $manualSchemaBuilder = new ManualSchemaBuilder($schemaDefinition);
        $schema = $manualSchemaBuilder->build();

        // THEN
        $this->assertInstanceOf(Schema::class, $schema);
    }
}
