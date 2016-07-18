<?php

namespace Bobthecow\Bundle\MustacheBundle\Test\Functional;

use Bobthecow\Bundle\MustacheBundle\Test\Functional\SmokeTest\TestKernel;

final class SmokeTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function it_renders_a_template()
    {
        $kernel = new TestKernel();
        $kernel->boot();

        $templating = $kernel->getContainer()->get('templating');

        $this->assertSame('foo bar', trim($templating->render('TestBundle::one.html.mustache', array('one' => 'foo', 'two' => 'bar'))));
    }
}
