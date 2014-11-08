<?php namespace Tests\Phpislove\Analyser;

use PHPUnit_Framework_TestCase as TestCase;
use Phpislove\Analyser\ProjectsList;

class ProjectsListTest extends TestCase {

    protected $instance;

    function setUp()
    {
        $this->instance = new ProjectsList(getcwd());
    }

    /** @test */ function it_is_initializable()
    {
        $this->assertInstanceOf(
            'Phpislove\Analyser\ProjectsList',
            $this->instance
        );
    }

    /** @test */ function it_adds_a_project()
    {
        $this->instance->add('path/to/project', 'my-project');

        $this->assertEquals(
            ['projects' => ['my-project' => ['path' => 'path/to/project']]],
            json_decode(file_get_contents(getcwd().'/projects.json'), true)
        );
    }

}
