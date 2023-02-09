<?php

declare(strict_types=1);

namespace Wata\DwhQueryBundle\Schema;

use GraphQL\Type\Schema;

interface SchemaBuilderInterface
{
    public function build(): Schema;
}
