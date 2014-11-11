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
        $path = getcwd().'/tests/fixtures';

        $this->instance->add($path, 'my_project');

        $projects =
            json_decode(file_get_contents(getcwd().'/projects.json'), true);

        $this->assertEquals($projects['projects']['my_project']['path'], $path);
    }

    /** @test */ function it_returns_all_added_projects()
    {
        $this->assertEquals(
            $this->instance->getAll()['projects']['my_project']['path'],
            getcwd().'/tests/fixtures'
        );
    }

    /** @test */ function it_filters_all_added_projects()
    {
        $this->instance->setProjects([
            'projects' => [
                'my_project' => [
                    'path' => getcwd().'/tests/fixtures'
                ],
            ],
        ]);

        $projects = $this->instance->filterAll(function($projectInfo)
        {
            return $projectInfo->getLanguage() == 'ruby';
        });

        $this->assertCount(0, $projects);
    }

}
