<?php

namespace Bobthecow\Bundle\MustacheBundle\Test\Functional\SmokeTest;

use Bobthecow\Bundle\MustacheBundle\BobthecowMustacheBundle;
use Symfony\Bundle\FrameworkBundle\FrameworkBundle;
use Symfony\Component\Config\Loader\LoaderInterface;
use Symfony\Component\HttpKernel\Kernel;

final class TestKernel extends Kernel
{
    private $tempDir;

    public function __construct()
    {
        parent::__construct('test', true);

        $this->tempDir = sys_get_temp_dir() . '/' . uniqid();
        mkdir($this->tempDir, 0777, true);
    }

    public function registerBundles()
    {
        return array(
            new BobthecowMustacheBundle(),
            new FrameworkBundle(),
            new TestBundle(),
        );
    }

    public function registerContainerConfiguration(LoaderInterface $loader)
    {
        $loader->load(__DIR__ . '/config.yml');
    }

    public function getCacheDir()
    {
        return $this->tempDir . '/cache';
    }

    public function getLogDir()
    {
        return $this->tempDir . '/logs';
    }
}
