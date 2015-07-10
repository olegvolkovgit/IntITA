<?php
/**
 * Created by PhpStorm.
 * User: Wizlight
 * Date: 09.07.2015
 * Time: 23:58
 */
class AboutUsHelper
{
    public static function getIdTabAboutUs($index)
    {
        switch ($index){
            case '1':
                $idblock = 'firstblock';
                break;
            case '2':
                $idblock = 'secondblock';
                break;
            case '3':
                $idblock = 'threeblock';
                break;
            default:
                $idblock = '';
        }
        return $idblock;
    }
}