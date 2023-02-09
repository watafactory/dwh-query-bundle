<?php

declare(strict_types=1);

namespace Wata\DwhQueryBundle\DependencyInjection;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Extension\Extension;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;
use Wata\DwhQueryBundle\Transformer\TransformerInterface;
use Wata\DwhQueryBundle\Interceptor\PreInterceptorInterface;
use Wata\DwhQueryBundle\Resolver\QueryResolverInterface;

class DwhQueryExtension extends Extension
{
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        $container->setAlias($this->getAlias() . '.schema_builder', $config['schema_builder']);
        $container->setParameter($this->getAlias() . '.schemas_dir', $config['schemas_dir']);
        $container->setAlias($this->getAlias() . '.default_field_resolver', $config['default_field_resolver']);

        $this->registerForAutoconfiguration($container);

        $loader = new YamlFileLoader($container, new FileLocator(__DIR__ . '/../Resources/config'));
        $loader->load('services.yaml');
    }

    private function registerForAutoconfiguration(ContainerBuilder $container): void
    {
        $container->registerForAutoconfiguration(QueryResolverInterface::class)
            ->addTag($this->getAlias() . '.query_resolver');

        $container->registerForAutoconfiguration(PreInterceptorInterface::class)
            ->addTag($this->getAlias() . '.pre_interceptor');

        $container->registerForAutoconfiguration(TransformerInterface::class)
            ->addTag($this->getAlias() . '.transformer');
    }

}
