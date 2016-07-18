<?php

/*
 * This file is part of the Mustache.php bundle for Symfony2.
 *
 * (c) 2012 Justin Hileman
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Bobthecow\Bundle\MustacheBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Bobthecow\Bundle\MustacheBundle\DependencyInjection\Compiler\MustacheHelperPass;

class BobthecowMustacheBundle extends Bundle
{
    public function build(ContainerBuilder $container)
    {
        parent::build($container);

        $container->addCompilerPass(new MustacheHelperPass());
    }
}
