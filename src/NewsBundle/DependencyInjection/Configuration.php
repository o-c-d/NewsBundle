<?php

namespace Ocd\NewsBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * This is the class that validates and merges configuration from your app/config files
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html#cookbook-bundles-extension-config-class}
 */
class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritDoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root(OcdNewsExtension::CONFIG_NAME);

        $rootNode
            ->children()
                ->arrayNode('news_home')
                    ->addDefaultsIfNotSet()
                    ->children()
                        ->scalarNode('items_per_page')
                            ->defaultValue(10)
                            ->cannotBeEmpty()
                        ->end()
                        ->arrayNode('options')
                            ->prototype('variable')->end()
                        ->end()
                    ->end()
                ->end()
                ->scalarNode('path')
                    ->defaultValue('%kernel.project_dir%/var/News')
                ->end()
            ->end();

        return $treeBuilder;
    }
}
