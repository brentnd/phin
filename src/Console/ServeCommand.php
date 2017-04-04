<?php

namespace Phin\Console;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;

class ServeCommand extends Command
{
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
        if (!$this->is_valid_site()) {
            $this->error("This is not a Phin site. Use `phin init` to create a new site.");
            return;
        }
        $this->info("Phin server starting on http://{$host}:{$port}");
        passthru("php -S {$host}:{$port} -t " . $this->base . '/public/');
    }
}