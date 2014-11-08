<?php namespace Phpislove\Analyser\Commands;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputArgument;
use Phpislove\Analyser\ProjectsList;

class AddProjectCommand extends Command {

    /**
     * @var ProjectsList
     */
    protected $projects;

    /**
     * @param ProjectsList|null $projects
     * @return AddProjectCommand
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
        $this->setName('add-project');
        $this->setDescription('Adds a new project for analysis');
        $this->addArgument('directory', InputArgument::REQUIRED, 'Project\'s directory');
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return void
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $name = $this->getProjectName($path = $input->getArgument('directory'));

        $this->projects->add($path, $name);

        $output->writeln("Added new project {$name} @ {$path}");
    }

    /**
     * @param string $directory
     * @return string
     */
    protected function getProjectName($directory)
    {
        $name = array_filter(explode('/', $directory));
        $name = end($name); // <3 PHP

        return implode(' ', array_map('ucfirst', explode('_', $name)));
    }

}
