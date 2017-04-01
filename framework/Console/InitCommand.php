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
        $copyFrom = __DIR__ . '/../../';
        $this->files->copyDirectory($copyFrom . '/framework/',  $this->base . '/framework/');
        $this->files->copyDirectory($copyFrom . '/public/',     $this->base . '/public/');
        $this->files->copyDirectory($copyFrom . '/resources/',  $this->base . '/resources/');
        $this->files->copyDirectory($copyFrom . '/site/',       $this->base . '/site/');
        $this->files->copy         ($copyFrom . '/.gitignore',  $this->base . '/.gitignore');
        $this->files->copy         ($copyFrom . '/gulpfile.js', $this->base . '/gulpfile.js');
        $this->files->copy         ($copyFrom . '/package.json',$this->base . '/package.json');
        $this->files->copy         ($copyFrom . '/phine',       $this->base . '/phine');
        // Copy doesn't preserve phine executableness, put it back
        $this->files->chmod($this->base . '/phine', 0755);
        $this->info("Phine initialized successfully!");
    }
}