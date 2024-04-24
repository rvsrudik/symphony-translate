<?php

require __DIR__.'/vendor/autoload.php';

use Symfony\Component\Console\Application;
use App\Console\TranslateCommand;

$application = new Application();

$application->add(new TranslateCommand());

$application->run();