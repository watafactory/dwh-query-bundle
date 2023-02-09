<?php

declare(strict_types=1);

namespace Wata\DwhQueryBundle\Executor;

interface ExecutorInterface
{
    public function execute(string $query): array;
}
