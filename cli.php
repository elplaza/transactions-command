#!/usr/bin/env php
<?php

require __DIR__.'/vendor/autoload.php';

use Symfony\Component\Console\Application;
use Payment\Command\TransactionsReportCommand;

$application = new Application();

// register commands
$application->add(new TransactionsReportCommand());

$application->run();
