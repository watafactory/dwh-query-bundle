<?php

declare(strict_types=1);

namespace Wata\DwhQueryBundle\Controller;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Wata\DwhQueryBundle\Executor\ExecutorInterface;

class DwhApiController
{
    private ExecutorInterface $executor;

    /**
     * @param ExecutorInterface $executor
     */
    public function __construct(ExecutorInterface $executor)
    {
        $this->executor = $executor;
    }

    public function __invoke(Request $request): Response
    {
        $content = $request->getContent();
        $result = $this->executor->execute($request->getContent());
        return new JsonResponse($result);
    }

}
