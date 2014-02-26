<?php
namespace Installer;

use Composer\Script\Event;
use Ouzo\Utilities\Path;

class PostCreateProject
{
    public static function changePrefix(Event $event)
    {
        $package = $event->getComposer()->getPackage();
        $path = $event->getComposer()->getInstallationManager()->getInstallPath($package);
        $path = str_replace('/vendor/letsdrink/ouzo-app', '', $path);
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

    public static function setConfig(Event $event)
    {
        $db = $event->getIO()->ask('Which db you choose?', 'mysql');
        $event->getIO()->write('User choose: ', $db);
    }
}