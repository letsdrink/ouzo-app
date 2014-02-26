<?php
use Ouzo\Loader;
use Ouzo\Utilities\Clock;

error_reporting(E_ALL);

putenv('environment=test');

define('ROOT_PATH', realpath(dirname(__FILE__)) . DIRECTORY_SEPARATOR);

require 'vendor/autoload.php';

require_once ROOT_PATH . 'vendor/letsdrink/ouzo/src/Ouzo/Loader.php';
require_once ROOT_PATH . 'vendor/letsdrink/ouzo/src/Ouzo/FrontController.php';
require_once ROOT_PATH . 'vendor/letsdrink/ouzo/src/Ouzo/Error.php';
$routesFilename = ROOT_PATH . 'config/routes.php';

if (file_exists($routesFilename)) {
    include_once $routesFilename;
}

$loader = new Loader();
$loader
    ->setIncludePath('custom/')
    ->setIncludePath('application/')
    ->setIncludePath('locales/')
    ->setIncludePath('test/application/')
    ->setIncludePath('test/seed/')
    ->setIncludePath('seed/')
    ->register();

Clock::freeze();