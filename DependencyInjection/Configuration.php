<?php

/*
 * This file is part of the Mustache.php bundle for Symfony2.
 *
 * (c) 2012 Justin Hileman
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Bobthecow\Bundle\MustacheBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\ArrayNodeDefinition;
use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * MustacheExtension configuration structure.
 */
class Configuration implements ConfigurationInterface
{
    /**
     * Generates the configuration tree builder.
     *
     * @return \Symfony\Component\Config\Definition\Builder\TreeBuilder The tree builder
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('mustache');

        $rootNode
            ->setInfo('Mustache Configuration');

        $this->addGlobalsSection($rootNode);
        $this->addMustacheOptions($rootNode);

        return $treeBuilder;
    }

    private function addGlobalsSection(ArrayNodeDefinition $rootNode)
    {
        $rootNode
            ->fixXmlConfig('global')
            ->children()
                ->arrayNode('globals')
                    ->useAttributeAsKey('key')
                    ->setExample(array('foo' => '"@bar"', 'pi' => 3.14))
                    ->prototype('array')
                        ->beforeNormalization()
                            ->ifTrue(function($v){ return is_string($v) && 0 === strpos($v, '@'); })
                            ->then(function($v){ return array('id' => substr($v, 1), 'type' => 'service'); })
                        ->end()
                        ->beforeNormalization()
                            ->ifTrue(function($v){
                                if (is_array($v)) {
                                    $keys = array_keys($v);
                                    sort($keys);

                                    return $keys !== array('id', 'type') && $keys !== array('value');
                                }

                                return true;
                            })
                            ->then(function($v){ return array('value' => $v); })
                        ->end()
                        ->children()
                            ->scalarNode('id')->end()
                            ->scalarNode('type')
                                ->validate()
                                    ->ifNotInArray(array('service'))
                                    ->thenInvalid('The %s type is not supported')
                                ->end()
                            ->end()
                            ->variableNode('value')->end()
                        ->end()
                    ->end()
                ->end()
            ->end()
        ;
    }

    private function addMustacheOptions(ArrayNodeDefinition $rootNode)
    {
        $rootNode
            ->children()
                ->scalarNode('template_class_prefix')->setExample('__Mustache_')->end()
                ->scalarNode('template_base_class')->setExample('Mustache_Template')->end()
                ->scalarNode('cache')->defaultValue('%kernel.cache_dir%/mustache')->end()
                ->scalarNode('loader_id')->defaultValue('mustache.loader')->end()
                ->scalarNode('partials_loader_id')->defaultValue('mustache.loader')->end()
                ->scalarNode('charset')->defaultValue('%kernel.charset%')->end()
            ->end()
        ;
    }
}
