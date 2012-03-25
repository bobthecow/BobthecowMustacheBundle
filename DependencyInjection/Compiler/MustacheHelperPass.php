<?php

/*
 * This file is part of the Mustache.php bundle for Symfony2.
 *
 * (c) 2012 Justin Hileman
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Bobthecow\Bundle\BobthecowMustacheBundle\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\Reference;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;

/**
 * Adds tagged mustache.helper services to mustache service
 */
class MustacheHelperPass implements CompilerPassInterface
{
    public function process(ContainerBuilder $container)
    {
        if (false === $container->hasDefinition('mustache')) {
            return;
        }

        $definition = $container->getDefinition('mustache');
        foreach ($container->findTaggedServiceIds('mustache.helper') as $id => $attributes) {
            $definition->addMethodCall('addHelper', array(new Reference($id)));
        }
    }
}
