<?php

declare(strict_types=1);

namespace Wata\DwhQueryBundle\Transformer;

interface TransformerInterface
{
    public function __invoke($object);
}
