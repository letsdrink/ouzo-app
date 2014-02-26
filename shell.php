<?php
use Ouzo\Loader;
use Ouzo\Shell\Dispatcher;

putenv('environment=prod');

define('ROOT_PATH', realpath(dirname(__FILE__)) . DIRECTORY_SEPARATOR);

require 'vendor/autoload.php';

include_once ROOT_PATH . 'config/routes.php';

$loader = new Loader();
$loader
    ->setIncludePath('application/')
    ->setIncludePath('lib/')
    ->setIncludePath('seed/')
    ->setIncludePath('vendor/letsdrink/ouzo/bin/')
    ->register();

Dispatcher::runScript($argv);