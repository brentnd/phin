<?php

namespace Phin\Console;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;
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
            )
            ->addOption(
                'bare',
                'b',
                InputOption::VALUE_NONE,
                'Install without assets or controllers'
            );
    }

    protected function fire()
    {
        if ($base = $this->input->getArgument('name')) {
            $this->base .= '/' . $base;
        }
        if (file_exists($this->base . '/bootstrap/phin.php')) {
            $this->error("Cannot init Phin, already initialized as Phin site.");
            return;
        }

        // Copy the Phin project into the new site directory
        $copyFrom = __DIR__ . '/../../';
        if ($this->input->hasOption('bare')) {
            $this->info('Skipping resources and controllers');
            $this->files->makeDirectory($this->base);
            $this->files->makeDirectory($this->base . '/public/');
            $this->files->makeDirectory($this->base . '/resources/');
            $this->files->makeDirectory($this->base . '/resources/assets/');
            $this->files->makeDirectory($this->base . '/resources/assets/js/');
            $this->files->makeDirectory($this->base . '/resources/assets/sass/');
            $this->files->makeDirectory($this->base . '/resources/views/');
            $this->files->makeDirectory($this->base . '/site/');
            $this->files->copyDirectory($copyFrom . '/site/bootstrap/', $this->base . '/bootstrap/');
            $this->files->copyDirectory($copyFrom . '/site/bootstrap/', $this->base . '/bootstrap/');
            $this->files->copy($copyFrom . '/site/public/.htaccess', $this->base . '/public/.htaccess');
            $this->files->copy($copyFrom . '/site/public/index.php', $this->base . '/public/index.php');
            $this->files->copy($copyFrom . '/site/public/index.php', $this->base . '/public/index.php');
            $this->files->copy($copyFrom . '/site/site/routes.php',  $this->base . '/site/routes.php');
            $this->files->copy($copyFrom . '/site/config.php',       $this->base . '/config.php');
        } else {
            $this->files->copyDirectory($copyFrom . '/site/', $this->base);
        }

        if (!file_exists($this->base . '/composer.json')) {
            $this->info("Installing brentnd/phin with composer in {$this->base}");
            chdir($this->base);
            passthru('composer require brentnd/phin');
        }
        $this->info("Phin initialized successfully!");
    }
}