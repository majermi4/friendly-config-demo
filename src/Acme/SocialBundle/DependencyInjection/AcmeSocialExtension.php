<?php
declare(strict_types=1);

namespace Acme\SocialBundle\DependencyInjection;

use Acme\SocialBundle\Configuration\SocialBundleConfig;
use Majermi4\FriendlyConfig\FriendlyConfiguration;
use Majermi4\FriendlyConfig\RegisterConfigService;
use Symfony\Component\Config\Definition\ConfigurationInterface;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;

class AcmeSocialExtension extends Extension
{
    public function getConfiguration(array $config, ContainerBuilder $container) : ConfigurationInterface
    {
        return FriendlyConfiguration::fromClass(SocialBundleConfig::class, 'acme_social');
    }

    /**
     * {@inheritdoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $config = $this->processConfiguration($this->getConfiguration($configs, $container), $configs);
        RegisterConfigService::fromProcessedConfig(SocialBundleConfig::class, $config, $container);

        $loader = new Loader\YamlFileLoader($container, new FileLocator(__DIR__ . '/../Resources/config'));
        $loader->load('services.yml');
    }
}
