<?php
namespace Bin;

require_once '../vendor/autoload.php';

use Composer\Script\Event;

class PostCreateProject
{
    public static function changePrefix(Event $event)
    {
        $prefixSystem = $event->getComposer()->getPackage()->getTargetDir();
        print_r($prefixSystem);
        print_r(__DIR__);
    }
}