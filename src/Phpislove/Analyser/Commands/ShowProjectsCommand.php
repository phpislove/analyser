<?php namespace Phpislove\Analyser\Commands;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class ShowProjectsCommand extends Command {

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

    }

}
