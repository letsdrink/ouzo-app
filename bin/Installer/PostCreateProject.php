<?php
namespace Installer;

use Composer\Script\Event;
use Ouzo\Utilities\Path;

class PostCreateProject
{
    public static function setConfig(Event $event)
    {
        $event->getIO()->write("\n<info>Which db you choose?<info>");
        $event->getIO()->write("1) mysql \n2) sqlite3 \n3) postgres");
        $code = $event->getIO()->ask("Choose [1], 2 or 3: ", '1');
        $translated = self::_translateDbCode($code);

        if (in_array($code, array(1, 2, 3))) {
            $event->getIO()->write('You choose <info>' . $code . ' - ' . $translated . '</info>.');
            self::_prepareToCopyConfig($code, self::_getPath($event));
        } else {
            $event->getIO()->write('<error>' . $translated . '</error>');
        }
    }

    private static function _translateDbCode($code)
    {
        switch ($code) {
            case 1:
                return 'mysql';
            case 2:
                return 'sqlite3';
            case 3:
                return 'postgres';
            default:
                return 'Wrong choose!';
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
        $configPath = Path::join($path, 'config', $conf, 'config.php');
        $config = file_get_contents($configPath);
        $configReplaced = str_replace('ouzo-test', $prefix, $config);
        file_put_contents($configPath, $configReplaced);
    }

    public static function changeDbName(Event $event)
    {
        $path = self::_getPath($event);
        $db_name = basename($path);
        self::_changeDbName('prod', $path, $db_name);
        self::_changeDbName('test', $path, $db_name . '_test');
    }

    private static function _changeDbName($conf, $path, $db_name)
    {
        $configPath = Path::join($path, 'config', $conf, 'config.php');
        $config = file_get_contents($configPath);
        $configReplaced = str_replace('app', $db_name, $config);
        file_put_contents($configPath, $configReplaced);
    }

    private static function _getPath(Event $event)
    {
        $package = $event->getComposer()->getPackage();
        $path = $event->getComposer()->getInstallationManager()->getInstallPath($package);
        $path = str_replace('/vendor/letsdrink/ouzo-app', '', $path);
        return $path;
    }
}