<?php namespace Phpislove\Analyser\Commands;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputArgument;

class AddProjectCommand extends Command {

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
        $output->writeln($input->getArgument('directory'));
    }

}
