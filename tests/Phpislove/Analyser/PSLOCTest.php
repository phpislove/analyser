<?php namespace Tests\Phpislove\Analyser;

use PHPUnit_Framework_TestCase as TestCase;
use Phpislove\Analyser\PSLOC;

class PSLOCTest extends TestCase {

    protected $instance;

    function setUp()
    {
        $this->instance = new PSLOC;
    }

    /** @test */ function it_is_initializable()
    {
        $this->assertInstanceOf('Phpislove\Analyser\PSLOC', $this->instance);
    }

    /** @test */ function it_performs_correct_calculations()
    {
        $this->assertEquals(
            $this->instance->count(getcwd().'/tests/fixtures/psloc-example.php'),
            8
        );
    }

}
