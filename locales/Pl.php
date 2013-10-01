<?php
class Pl
{
    static $labels = array(
        'user' => array(
            'login' => 'login',
            'password' => 'password'
        )
    );

    static function getLabels()
    {
        return self::$labels;
    }
}