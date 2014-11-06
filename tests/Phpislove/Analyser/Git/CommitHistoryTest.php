<?php namespace Tests\Phpislove\Analyser\Git;

use PHPUnit_Framework_TestCase as TestCase;
use Phpislove\Analyser\Git\CommitHistory;

class CommitHistoryTest extends TestCase {

    protected $instance;

    function setUp()
    {
        $this->instance = new CommitHistory;
    }

    /** @test */ function it_is_initializable()
    {
        $this->assertInstanceOf(
            'Phpislove\Analyser\Git\CommitHistory',
            $this->instance
        );
    }

}
