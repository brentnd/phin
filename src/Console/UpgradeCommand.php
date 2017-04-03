<?php

namespace Phin\Console;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;
use Illuminate\Filesystem\Filesystem;

class UpgradeCommand extends Command
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
        $this->setName('upgrade')
            ->setDescription('Upgrade an existing Phin project.');
    }

    protected function fire()
    {
        if (!file_exists($this->base . '/bootstrap/phin.php')) {
            $this->error("Cannot upgrade Phin, not initialized as Phin site.");
            return;
        }

        $copyFrom = __DIR__ . '/../../';
        $this->files->copyDirectory($copyFrom . '/site/bootstrap/', $this->base . '/bootstrap/');
        $this->files->copy($copyFrom . '/site/public/.htaccess', $this->base . '/public/.htaccess');
        $this->files->copy($copyFrom . '/site/public/index.php', $this->base . '/public/index.php');
        $this->info("Phin upgraded successfully!");
    }
}