<?php

namespace Phine\Console;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;

class ServeCommand extends Command
{
    private $app;

    public function __construct($app)
    {
        $this->app = $app;
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
        $this->info("Server started on http://{$host}:{$port}");
        passthru("php -S {$host}:{$port} -t " . public_path());
    }
}