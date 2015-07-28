<?php
/**
 * Created by PhpStorm.
 * User: Ivanna
 * Date: 21.07.2015
 * Time: 15:35
 */

class TestsHelper {

    public static function getOptionsNum($block){

        $test = TestsHelper::getTestId($block);
        $criteria = new CDbCriteria();
        $criteria->select = 'answer';
        $criteria->condition = 'id_test = :id_test';
        $criteria->params = array(':id_test'=>$test);
        $optionsNum = TestsAnswers::model()->count($criteria);

        return $optionsNum;
    }

    public static function getOptions($block){

        $test = TestsHelper::getTestId($block);
        $criteria = new CDbCriteria();
        $criteria->select = 'answer';
        $criteria->condition = 'id_test = '.$test;

        $options = TestsAnswers::model()->findAll($criteria);
        //var_dump($options);die();
        return $options;
    }

    public static function getTestId($block){
        return Tests::model()->findByAttributes(array('block_element' => $block))->id;
    }

    public static function getTestType($block){

        $test = TestsHelper::getTestId($block);

        $criteria = new CDbCriteria();
        $criteria->select = 'answer';
        $criteria->addCondition('id_test = :id_test and is_valid = 1');
        $criteria->params = array(':id_test' => $test);
        $count = TestsAnswers::model()->count($criteria);

        return ($count > 1)?2:1;
    }

    public static function getTypeButton($type){
        if($type == 1){
            return 'input:radio:checked';
        }elseif ($type == 2){
            return 'input:checkbox:checked';
        }
    }

}