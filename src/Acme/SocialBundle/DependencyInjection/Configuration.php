<?php
declare(strict_types=1);

namespace Acme\SocialBundle\DependencyInjection;

use Acme\SocialBundle\Configuration\EngagementTargetConfig;
use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritdoc}
     */
    public function getConfigTreeBuilder() : TreeBuilder
    {
        $treeBuilder = new TreeBuilder('acme_social');

        $treeBuilder->getRootNode()
            ->children()
                ->arrayNode('twitter')
                    ->info('Configures twitter client')
                    ->children()
                        ->integerNode('client_id')
                            ->isRequired()
                        ->end()
                        ->scalarNode('client_secret')
                            ->isRequired()
                        ->end()
                    ->end()
                ->end() // twitter
                ->arrayNode('facebook')
                    ->info('Configures facebook client')
                    ->children()
                        ->integerNode('client_id')
                            ->isRequired()
                        ->end()
                        ->scalarNode('client_secret')
                            ->isRequired()
                        ->end()
                    ->end()
                ->end() // facebook
                ->arrayNode('common')
                    ->info('Configures common social bundle configuration')
                    ->isRequired()
                    ->children()
                        ->scalarNode('default_username')
                            ->isRequired()
                        ->end()
                        ->integerNode('max_daily_posts')
                            ->isRequired()
                        ->end()
                        ->booleanNode('allow_comments_in_posts')
                            ->defaultFalse()
                        ->end()
                        ->arrayNode('hashtags')
                            ->scalarPrototype()->end()
                            ->isRequired()
                        ->end()
                        ->arrayNode('engagement_targets')
                            ->isRequired()
                            ->arrayPrototype()
                                ->children()
                                    ->enumNode('type')
                                        ->values(EngagementTargetConfig::TYPES)
                                        ->isRequired()
                                    ->end()
                                    ->integerNode('ideal_reactions_count')
                                        ->isRequired()
                                    ->end()
                                    ->integerNode('minimal_reactions_count')
                                        ->isRequired()
                                    ->end()
                                ->end()
                            ->end()
                        ->end()
                    ->end()
                ->end() // common
            ->end()
        ;

        return $treeBuilder;
    }
}
