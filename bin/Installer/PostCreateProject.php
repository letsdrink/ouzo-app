<?php
namespace Installer;

use Composer\Script\Event;

class PostCreateProject
{
    public static function changePrefix(Event $event)
    {
        $package = $event->getComposer()->getPackage();
        $prefixSystem = $event->getComposer()->getInstallationManager()->getInstallPath($package);
        $a = print_r($prefixSystem, true);
        $b = print_r(__DIR__, true);
        file_put_contents('/tmp/test1', $a);
        file_put_contents('/tmp/test2', $b);
    }
}