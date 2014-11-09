<?php namespace Phpislove\Analyser\Commands;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Phpislove\Analyser\ProjectsList;

class ShowProjectsCommand extends Command {

    /**
     * @var ProjectsList
     */
    protected $projects;

    /**
     * @param ProjectsList|null $projects
     * @return ShowProjectsCommand
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
        $this->setName('show-projects');
        $this->setDescription('Shows tracked projects');
        $this->addOption('language', null, InputOption::VALUE_REQUIRED, 'The desired programming language');
        $this->addOption('with-psloc', null, InputOption::VALUE_NONE, 'Whether you want PSLOC to be displayed');
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return void
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $psloc = $input->getOption('with-psloc');
        $language = $input->getOption('language');

        $projects = is_null($language) ?
            $this->projects->getAll() :
            $this->projects->filterAll(function($project) use($language)
            {
                return $project->getLanguage() == $language;
            })
        ;

        $output->writeln(sprintf('Showing tracked projects (%s)', count($projects)));

        if ( ! is_null($language))
        {
            $output->writeln('Only written in '.ucfirst($language));
        }
    }

}
