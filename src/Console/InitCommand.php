<?php

namespace Phin\Console;

use Symfony\Component\Console\Input\InputArgument;
use Illuminate\Filesystem\Filesystem;

class InitCommand extends Command
{
    private $files;
    private $base;

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

        // Copy the Phin project into the new site directory
        $copyFrom = __DIR__ . '/../../';
        $this->files->copyDirectory($copyFrom . '/bootstrap/',   $this->base . '/bootstrap/');
        $this->files->copyDirectory($copyFrom . '/public/',      $this->base . '/public/');
        $this->files->copyDirectory($copyFrom . '/resources/',   $this->base . '/resources/');
        $this->files->copyDirectory($copyFrom . '/site/',        $this->base . '/site/');
        $this->files->copy         ($copyFrom . '/gulpfile.js',  $this->base . '/gulpfile.js');
        $this->files->copy         ($copyFrom . '/package.json', $this->base . '/package.json');

        if (!file_exists($this->base . '/composer.json')) {
            $this->info("Installing brentnd/phin with composer in {$this->base}");
            chdir($this->base);
            passthru('composer require brentnd/phin');
        }
        $this->info("Phin initialized successfully!");
    }
}