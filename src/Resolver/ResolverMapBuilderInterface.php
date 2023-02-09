<?php

declare(strict_types=1);

namespace Wata\DwhQueryBundle\Resolver;

interface ResolverMapBuilderInterface
{
    public function getResolverMap(): array;
}
