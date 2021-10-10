<?php
declare(strict_types=1);

namespace Acme\SocialBundle\DependencyInjection;

use Acme\SocialBundle\Configuration\SocialBundleConfig;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Definition;
use Symfony\Component\DependencyInjection\Loader;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;

class AcmeSocialExtension extends Extension
{
    /**
     * {@inheritdoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        $loader = new Loader\YamlFileLoader($container, new FileLocator(__DIR__ . '/../Resources/config'));
        $loader->load('services.yml');

        $socialBundleConfigDefinition = new Definition(SocialBundleConfig::class, [$config]);
        $socialBundleConfigDefinition->setFactory([SocialBundleConfig::class, 'fromRawConfig']);
        $container->setDefinition(SocialBundleConfig::class, $socialBundleConfigDefinition);
    }
}
