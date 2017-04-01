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

        // Copy the Phine project into the new site directory
        $this->files->copyDirectory(__DIR__ . '/../../', $this->base);
        // If cloned from master, .git comes along, let's not.
        $this->files->deleteDirectory($this->base . '/.git', 0755);
        // Copy doesn't preserve phine executableness, put it back
        $this->files->chmod($this->base . '/phine', 0755);
        $this->info("Phine {$this->base} initialized successfully!");
    }
}