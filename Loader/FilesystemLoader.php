<?php

/*
 * This file is part of the Mustache.php bundle for Symfony2.
 *
 * (c) 2012 Justin Hileman
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Bobthecow\Bundle\BobthecowMustacheBundle\Loader;

use Symfony\Component\Templating\TemplateNameParserInterface;
use Symfony\Component\Config\FileLocatorInterface;

/**
 * FilesystemLoader extends the default Mustache filesystem loader
 * to work with the Symfony2 paths.
 */
class FilesystemLoader extends \Mustache_Loader_FilesystemLoader
{
    protected $locator;
    protected $parser;

    /**
     * Constructor.
     *
     * @param FileLocatorInterface        $locator A FileLocatorInterface instance
     * @param TemplateNameParserInterface $parser  A TemplateNameParserInterface instance
     */
    public function __construct(FileLocatorInterface $locator, TemplateNameParserInterface $parser)
    {
        parent::__construct(array());

        $this->locator = $locator;
        $this->parser = $parser;
        $this->cache = array();
    }

    /**
     * Helper function for getting a Mustache template file name.
     *
     * @param string $name
     *
     * @return string Template file name
     */
    protected function getFileName($name)
    {
        $name = (string) $name;

        try {
            $template = $this->parser->parse($name);
            $file = $this->locator->locate($template);
        } catch (\Exception $e) {
            throw new InvalidArgumentException(sprintf('Unable to find template "%s".', $name));
        }

        return $file;
    }
}
