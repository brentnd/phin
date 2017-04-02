<?php

namespace Phin\Console;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;

class ServeCommand extends Command
{
    private $base;

    public function __construct()
    {
        $this->base = getcwd();
        parent::__construct();
    }

    protected function configure()
    {
        $this->setName('serve')
            ->setDescription('Serve local site with php built-in server.')
            ->addOption(
                'host',
                null,
                InputOption::VALUE_REQUIRED,
                'What host should we bind to?',
                'localhost'
            )
            ->addOption(
                'port',
                'p',
                InputOption::VALUE_REQUIRED,
                'What port should we bind to?',
                8000
            );
    }

    protected function fire()
    {
        $host = $this->input->getOption('host');
        $port = $this->input->getOption('port');
        if (!file_exists($this->base . '/bootstrap/phin.php')) {
            $this->error("Cannot find /bootstrap/phin.php current directory.\nThis is required to serve a Phin site.");
            return;
        }
        if (!file_exists($this->base . '/public/index.php')) {
            $this->error("Cannot find /public/index.php current directory.\nThis is required to serve a Phin site.");
            return;
        }
        if (!file_exists($this->base . '/vendor')) {
            $this->error("Cannot find /vendor in current directory.\nThis is required to serve a Phin site.");
            return;
        }
        $this->info("Phin server starting on http://{$host}:{$port}");
        passthru("php -S {$host}:{$port} -t " . $this->base . '/public/');
    }
}