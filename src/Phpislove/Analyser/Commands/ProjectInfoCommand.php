<?php namespace Phpislove\Analyser\Commands;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputArgument;
use Phpislove\Analyser\ProjectsList;
use Phpislove\Analyser\ProjectInfo;
use Phpislove\Analyser\PSLOC;

class ProjectInfoCommand extends Command {

    /**
     * @var ProjectsList
     */
    protected $projects;

    /**
     * @param ProjectsList|null $projects
     * @return ProjectInfoCommand
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
        $this->setName('project-info');
        $this->setDescription('Shows specific project info');
        $this->addArgument('name', InputArgument::REQUIRED, 'Project name');
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return void
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $name = $input->getArgument('name');
        $project = $this->projects->getByName($this->convertProjectName($name));

        $output->writeln(sprintf(
            'Showing info about project "%s" (%s)',
            $name,
            $this->convertProjectName($name)
        ));

        $output->writeln(sprintf(
            'Written in %s, %s PSLOC',
            ucfirst((new ProjectInfo($project['path']))->getLanguage()),
            (new PSLOC)->directory($project['path'])
        ));

        if ($packages = (new ProjectInfo($project['path']))->getPackages())
        {
            $output->writeln(
                'Has these third-party packages: '.implode(' ', $packages)
            );
        }
    }

    /**
     * @param string $name
     * @return string
     */
    protected function convertProjectName($name)
    {
        return implode('_', array_map('lcfirst', explode(' ', $name)));
    }

}
