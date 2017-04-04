<?php

namespace Phin\Console;

use Symfony\Component\Console\Command\Command as SymfonyCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

abstract class Command extends SymfonyCommand
{
    protected $base;

    public function __construct()
    {
        $this->base = getcwd();
        parent::__construct();
    }

    public function execute(InputInterface $input, OutputInterface $output)
    {
        $this->input = $input;
        $this->output = $output;
        return (int) $this->fire();
    }

    protected function info($string)
    {
        $this->output->writeln("<info>{$string}</info>");
    }

    protected function error($string)
    {
        $this->output->writeln("<error>{$string}</error>");
    }

    protected function comment($string)
    {
        $this->output->writeln("<comment>{$string}</comment>");
    }

    protected function is_valid_site()
    {
        // Probably ambiguous with other frameworks which also have public/index.php.
        return file_exists($this->base . '/public/index.php');
    }

    abstract protected function fire();
}