<?php
namespace Bin;

use Composer\Script\Event;

class PostCreateProject
{
    public static function changePrefix(Event $event)
    {
        $prefixSystem = $event->getComposer()->getPackage()->getTargetDir();
        $a = print_r($prefixSystem, true);
        $b = print_r(__DIR__, true);
        file_put_contents('/tmp/test', $a . $b);
    }
}