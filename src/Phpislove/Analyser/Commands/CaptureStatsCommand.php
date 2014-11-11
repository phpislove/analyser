<?php namespace Phpislove\Analyser\Commands;

use Symfony\Component\Console\Command\Command;
use Phpislove\Analyser\ProjectsList;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class CaptureStatsCommand extends Command {

    /**
     * @var ProjectsList
     */
    protected $projects;

    /**
     * @param ProjectsList|null $projects
     * @return CaptureStatsCommand
     */
    public function __construct(ProjectsList $projects = null)
    {
        $this->projects = $projects ?: new ProjectsList(getcwd());

        parent::__construct();
    }

    /**
     * @return void
     */
    protected function configure()
    {
        $this->setName('capture-stats');
        $this->setDescription(
            'Goes through added projects and captures their PSLOC values'
        );
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return void
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln('Capturing PSLOC values...');

        foreach ($this->projects->getAll()['projects'] as $name => $project)
        {
            $this->projects->add($project['path'], $name);

            $output->writeln("Processing {$name}...");
        }
    }

}
