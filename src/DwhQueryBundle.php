<?php

declare(strict_types=1);

namespace Wata\DwhQueryBundle;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;
use Wata\DwhQueryBundle\DependencyInjection\Compiler\ResolverCompilerPass;
use Wata\DwhQueryBundle\DependencyInjection\Compiler\TypesCompilerPass;

class DwhQueryBundle extends Bundle
{
    public function build(ContainerBuilder $container)
    {
        parent::build($container);

        $container->addCompilerPass(new TypesCompilerPass());
        $container->addCompilerPass(new ResolverCompilerPass());
    }

}
