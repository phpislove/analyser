<?php namespace Tests\Phpislove\Analyser;

use PHPUnit_Framework_TestCase as TestCase;
use Phpislove\Analyser\ProjectInfo;

class ProjectInfoTest extends TestCase {

    protected $instance;

    function setUp()
    {
        $this->instance = new ProjectInfo(getcwd().'/tests/fixtures');
    }

    /** @test */ function it_is_initializable()
    {
        $this->assertInstanceOf('Phpislove\Analyser\ProjectInfo', $this->instance);
    }

    /** @test */ function it_returns_the_project_language()
    {
        $this->assertEquals('php', $this->instance->getLanguage());
    }

}
