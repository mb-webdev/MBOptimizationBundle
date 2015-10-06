<?php

namespace MB\Bundle\OptimizationBundle\DependencyInjection;

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
     * {@inheritdoc}
     */
    public function getConfigTreeBuilder()
    {
        $booleanArray = array(true, 'true', 1, '1', false, 'false', 0, '0');

        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('mb_optimization');

        $rootNode
            ->children()
                ->scalarNode('html_compress')->defaultTrue()->end()
                ->arrayNode('content_security_policy')
                    ->children()
                        ->scalarNode('enabled')
                            ->isRequired()
                            ->defaultTrue()
                            ->validate()
                            ->ifNotInArray($booleanArray)
                                ->thenInvalid('mb_optimization.content_security_policy.enabled must be defined and can only contain boolean value. %s given instead.')
                            ->end()
                        ->end()
                        ->arrayNode('value')
                            ->prototype('scalar')
                            ->end()
                        ->end()
                    ->end()
                ->end()


                ->arrayNode('x_xss_protection')
                    ->children()
                        ->scalarNode('enabled')
                            ->isRequired()
                            ->defaultTrue()
                            ->validate()
                            ->ifNotInArray($booleanArray)
                                ->thenInvalid('mb_optimization.x_xss_protection.enabled must be defined and can only contain boolean value. %s given instead.')
                            ->end()
                        ->end()
                        ->scalarNode('value')
                            ->defaultValue("1; mode=block")
                        ->end()
                    ->end()
                ->end()

                ->arrayNode('x_frame_options')
                    ->children()
                        ->scalarNode('enabled')
                            ->isRequired()
                            ->defaultTrue()
                            ->validate()
                            ->ifNotInArray($booleanArray)
                                ->thenInvalid('mb_optimization.x_frame_options.enabled must be defined and can only contain boolean value. %s given instead.')
                            ->end()
                        ->end()
                        ->scalarNode('value')
                            ->defaultValue("SAMEORIGIN")
                        ->end()
                    ->end()
                ->end()
            ->end()
        ->end();

        return $treeBuilder;
    }
}
