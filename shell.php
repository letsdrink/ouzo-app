<?php

putenv('environment=prod');

define('ROOT_PATH', realpath(dirname(__FILE__)) . DIRECTORY_SEPARATOR);

require 'vendor/autoload.php';

include_once ROOT_PATH . 'config/routes.php';

$loader = new \Ouzo\Loader();
$loader
    ->setIncludePath('application/')
    ->setIncludePath('lib/')
    ->setIncludePath('seed/')
    ->setIncludePath('vendor/bin/')
    ->register();

\Ouzo\Shell\Dispatcher::runScript($argv);
