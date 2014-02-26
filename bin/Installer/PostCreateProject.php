<?php
namespace Installer;

use Composer\Script\Event;
use Ouzo\Utilities\Path;

class PostCreateProject
{
    public static function setConfig(Event $event)
    {
        $event->getIO()->write("\n<info>  .ooooo.  oooo  oooo    oooooooo  .ooooo.<info>");
        $event->getIO()->write("<info> d88' `88b `888  `888   d'\"\"7d8P  d88' `88b<info>");
        $event->getIO()->write("<info> 888   888  888   888     .d8P'   888   888<info>");
        $event->getIO()->write("<info> 888   888  888   888   .d8P'  .P 888   888<info>");
        $event->getIO()->write("<info> `Y8bod8P'  `V88V\"V8P' d8888888P  `Y8bod8P'<info>");
        $event->getIO()->write("\n<info>            F R A M E W O R K<info>");
        $event->getIO()->write("\n[Ouzo] Choose a database that you want to use in your project (it can be changed later):");
        $event->getIO()->write(" 1) MySQL / MariaDB \n 2) SQLite \n 3) PostgreSQL");
        $code = $event->getIO()->ask("Choose [1], 2 or 3: ", '1');
        $translated = self::_translateDbCode($code);

        if (in_array($code, array(1, 2, 3))) {
            $event->getIO()->write("<info>Setting up $translated Done!</info>");
            $path = self::_getPath($event);
            self::_prepareToCopyConfig($code, $path);
            self::_changeDnsIfSqlite3($code, $path, 'prod');
            self::_changeDnsIfSqlite3($code, $path, 'test');
        } else {
            $event->getIO()->write('<error>' . $translated . '</error>');
        }
        $event->getIO()->write('For more info about Ouzo check out http://ouzoframework.org');
    }

    private static function _translateDbCode($code)
    {
        switch ($code) {
            case 1:
                return 'MySQL / MariaDB';
            case 2:
                return 'SQLite';
            case 3:
                return 'PostgreSQL';
            default:
                return 'Wrong selection!';
        }
    }

    private static function _prepareToCopyConfig($db, $path)
    {
        switch ($db) {
            case 1:
                self::_copyConfig($path, 'mysql');
                break;
            case 2:
                self::_copyConfig($path, 'sqlite3');
                break;
            case 3:
                self::_copyConfig($path, 'postgres');
                break;
        }
    }

    private static function _changeDnsIfSqlite3($code, $path, $conf)
    {
        if ($code == 2) {
            $db_name = self::_prepareNewDbName(basename($path));
            $newDbName = $conf == 'test' ? $db_name . '_test' : $db_name;

            $dir = Path::join($path, 'db', 'sqlite');
            if (!file_exists($dir)) {
                mkdir($dir);
            }

            $dbNameWithPath = Path::join($path, 'db', 'sqlite', $newDbName);
            self::_replaceValue($path, $conf, 'sqlite:ouzo_test', 'sqlite:' . $dbNameWithPath);

            $source = Path::join(__DIR__, 'stubs', 'sqlite3_db');
            copy($source, $dbNameWithPath);
            chmod($dbNameWithPath, 0777);
        }
    }

    private static function _copyConfig($path, $type)
    {
        $sourceProd = Path::join(__DIR__, 'stubs', $type . '.prod.config.php.stub');
        $sourceTest = Path::join(__DIR__, 'stubs', $type . '.test.config.php.stub');

        $destinationProd = Path::join($path, 'config', 'prod', 'config.php');
        $destinationTest = Path::join($path, 'config', 'test', 'config.php');

        copy($sourceProd, $destinationProd);
        copy($sourceTest, $destinationTest);
    }

    public static function changePrefix(Event $event)
    {
        $path = self::_getPath($event);
        $prefix = basename($path);
        self::_changePrefix('prod', $path, $prefix);
        self::_changePrefix('test', $path, $prefix);
    }

    private static function _changePrefix($conf, $path, $prefix)
    {
        self::_replaceValue($path, $conf, 'ouzo-test', $prefix);
    }

    public static function changeDbName(Event $event)
    {
        $path = self::_getPath($event);
        $db_name = self::_prepareNewDbName(basename($path));
        self::_changeDbName('prod', $path, $db_name);
        self::_changeDbName('test', $path, $db_name);
    }

    private static function _prepareNewDbName($db_name)
    {
        return preg_replace('/\W/', '_', $db_name);
    }

    private static function _changeDbName($conf, $path, $db_name)
    {
        self::_replaceValue($path, $conf, 'app', $db_name);
    }

    private static function _getPath(Event $event)
    {
        $package = $event->getComposer()->getPackage();
        $path = $event->getComposer()->getInstallationManager()->getInstallPath($package);
        $path = str_replace('/vendor/letsdrink/ouzo-app', '', $path);
        return $path;
    }

    private static function _replaceValue($path, $conf, $search, $replacement)
    {
        $configPath = Path::join($path, 'config', $conf, 'config.php');
        $config = file_get_contents($configPath);
        $configReplaced = str_replace($search, $replacement, $config);
        file_put_contents($configPath, $configReplaced);
    }
}