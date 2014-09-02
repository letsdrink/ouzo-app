<?php
use Ouzo\Utilities\Clock;
use Ouzo\Utilities\Files;
use Ouzo\Utilities\Path;

error_reporting(E_ALL);

putenv('environment=test');

define('ROOT_PATH', realpath(dirname(__FILE__)) . DIRECTORY_SEPARATOR);

require 'vendor/autoload.php';

Files::loadIfExists(Path::join(ROOT_PATH, 'config', 'error_codes.php'));
Files::loadIfExists(Path::join(ROOT_PATH, 'config', 'routes.php'));

Clock::freeze();