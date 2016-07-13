#!/usr/bin/env php
<?php
// application.php

require_once __DIR__.'/vendor/autoload.php';
require_once __DIR__.'/GreetCommand.php';
require_once __DIR__.'/Database.php';

use Acme\Console\Command\GreetCommand;
use Symfony\Component\Console\Application;

$application = new Application();
$application->add(new GreetCommand());
$application->run();