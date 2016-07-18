<?php

/*
 * This file is part of the Mustache.php bundle for Symfony2.
 *
 * (c) 2012 Justin Hileman
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Bobthecow\Bundle\MustacheBundle\Assetic;

use Assetic\Factory\Loader\FormulaLoaderInterface;
use Assetic\Factory\Resource\ResourceInterface;

/**
 * Does absolutely nothing.
 */
class FakeFormulaLoader implements FormulaLoaderInterface
{
    /**
     * Does absolutely nothing.
     *
     * @param ResourceInterface $resource A resource
     *
     * @return array Just an empty array
     */
    public function load(ResourceInterface $resource)
    {
        return array();
    }
}
