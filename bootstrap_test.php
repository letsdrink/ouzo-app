<?php
use Ouzo\Loader;
use Ouzo\Utilities\Clock;
use Ouzo\Utilities\Files;
use Ouzo\Utilities\Path;

error_reporting(E_ALL);

putenv('environment=test');

define('ROOT_PATH', realpath(dirname(__FILE__)) . DIRECTORY_SEPARATOR);

require 'vendor/autoload.php';

Files::loadIfExists(Path::join(ROOT_PATH, 'vendor', 'letsdrink', 'ouzo', 'src', 'Ouzo', 'Loader.php'));
Files::loadIfExists(Path::join(ROOT_PATH, 'vendor', 'letsdrink', 'ouzo', 'src', 'Ouzo', 'FrontController.php'));
Files::loadIfExists(Path::join(ROOT_PATH, 'vendor', 'letsdrink', 'ouzo', 'src', 'Ouzo', 'ExceptionHandling', 'ErrorHandler.php'));

Files::loadIfExists(Path::join(ROOT_PATH, 'config', 'error_codes.php'));
Files::loadIfExists(Path::join(ROOT_PATH, 'config', 'routes.php'));

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