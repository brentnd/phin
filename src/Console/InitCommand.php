<?php

namespace Phin\Console;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;
use Illuminate\Filesystem\Filesystem;

class InitCommand extends Command
{
    private $files;

    public function __construct()
    {
        $this->files = new Filesystem;
        $this->base = getcwd();
        parent::__construct();
    }

    protected function configure()
    {
        $this->setName('init')
            ->setDescription('Initialize a new Phin project.')
            ->addArgument(
                'name',
                InputArgument::OPTIONAL,
                'Where should we initialize this project?'
            );
    }

    protected function fire()
    {
        if ($base = $this->input->getArgument('name')) {
            $this->base .= '/' . $base;
        }
        if ($this->is_valid_site()) {
            $this->error("Cannot init Phin, already initialized as Phin site.");
            return;
        }

        // Copy the Phin project into the new site directory
        $copyFrom = __DIR__ . '/../../';
        $this->files->copyDirectory($copyFrom . '/site/', $this->base);
        $this->files->copy($this->base . '/.env.example', $this->base . '/.env');
        $this->info("Phin initialized successfully!");
    }
}