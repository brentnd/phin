<?php

namespace Phine\Console;

use Symfony\Component\Console\Input\InputArgument;
use Illuminate\Filesystem\Filesystem;

class InitCommand extends Command
{
    private $files;

    public function __construct($app)
    {
        $this->files = $app['files'];
        $this->base = getcwd();
        parent::__construct();
    }

    protected function configure()
    {
        $this->setName('init')
            ->setDescription('Initialize a new Phine project.')
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

        $this->files->copyDirectory(__DIR__ . '/../../', $this->base);
        $this->info("Phine {$this->base} initialized successfully!");
    }
}