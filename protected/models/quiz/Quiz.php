<?php
/**
 * Created by PhpStorm.
 * User: Quicks
 * Date: 05.11.2015
 * Time: 16:32
 */
//namespace application\models\quiz;

abstract class Quiz extends CActiveRecord {

   abstract public function addTask($arr);

}