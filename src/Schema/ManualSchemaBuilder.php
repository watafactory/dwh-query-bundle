<?php

declare(strict_types=1);

namespace Wata\DwhQueryBundle\Schema;

use GraphQL\Type\Schema;
use GraphQL\Utils\BuildSchema;

class ManualSchemaBuilder implements SchemaBuilderInterface
{
    private string $schemaDefinition;

    /**
     * @param string $schemaDefinition
     */
    public function __construct(string $schemaDefinition)
    {
        $this->schemaDefinition = $schemaDefinition;
    }

    public function build(): Schema
    {
        return BuildSchema::build($this->schemaDefinition);
    }

}
