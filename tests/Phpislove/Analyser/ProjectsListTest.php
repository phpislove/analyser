<?php namespace Tests\Phpislove\Analyser;

use PHPUnit_Framework_TestCase as TestCase;
use Phpislove\Analyser\ProjectsList;

class ProjectsListTest extends TestCase {

    protected $instance;

    function setUp()
    {
        $this->instance = new ProjectsList;
    }

    /** @test */ function it_is_initializable()
    {
        $this->assertInstanceOf(
            'Phpislove\Analyser\ProjectsList',
            $this->instance
        );
    }

}
