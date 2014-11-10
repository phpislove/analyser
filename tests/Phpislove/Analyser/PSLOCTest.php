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

    /** @test */ function it_scans_gitignore_to_skip_undesirable_files_and_folders()
    {
        $this->assertEquals([], $this->instance->parseGitIgnoreFile(uniqid()));

        $this->assertEquals(
            $this->instance->parseGitIgnoreFile(getcwd().'/tests/fixtures/test-project'),
            ['vendor', 'composer.lock']
        );
    }

}
