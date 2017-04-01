<?php

namespace Phine\Console;

use Symfony\Component\Console\Input\InputArgument;
use Illuminate\Filesystem\Filesystem;

class UpgradeCommand extends Command
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
        $this->setName('upgrade')
            ->setDescription('Update Phine framework to latest from composer/vendor.');
    }

    protected function fire()
    {
        if (!file_exists($this->base . '/vendor/brentnd/phine') ||
            !file_exists($this->base . '/framework')) {
            $this->error("`phine upgrade` can only be run from an installed site.");
            return false;
        }
        // Copy the latest Phine framework from vendor into framework
        $phine = $this->base . '/vendor/brentnd/phine';
        $this->files->copyDirectory($phine . '/framework',        $this->base . '/framework');
        $this->files->copy         ($phine . '/public/index.php', $this->base . '/public/index.php');
        $this->files->copy         ($phine . '/phine',            $this->base . '/phine');
        // Copy doesn't preserve phine executableness, put it back
        $this->files->chmod($this->base . '/phine', 0755);
        $this->info("Phine upgraded successfully!");
    }
}