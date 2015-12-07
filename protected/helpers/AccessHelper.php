<?php

/**
 * Created by PhpStorm.
 * User: Ivanna
 * Date: 22.05.2015
 * Time: 14:35
 */
class AccessHelper
{
    public static function getFlag($rights, $type)
    {
        $result = false;
        switch ($type) {
            case 'read':
                if ($rights &= 1 << 0)
                    $result = true;
                break;
            case 'edit':
                if ($rights &= 1 << 1)
                    $result = true;
                break;
            case 'create':
                if ($rights &= 1 << 2)
                    $result = true;
                break;
            case 'delete':
                if ($rights &= 1 << 3)
                    $result = true;
                break;
        }
        return ($result) ? '+' : '';
    }
}
