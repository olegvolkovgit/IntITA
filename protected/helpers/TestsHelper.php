<?php
/**
 * Created by PhpStorm.
 * User: Ivanna
 * Date: 21.07.2015
 * Time: 15:35
 */

class TestsHelper {



    public static function getAnswerKey($block){
        $answerKey =[];
        $test = TestsAnswers::model()->findAllByAttributes(array('id_test' => Tests::getTestId($block)));
        foreach($test as $answerid){
            array_push($answerKey, $answerid->id);
        }
        return $answerKey;
    }

    public static function getTestCondition($block){
        return LectureElement::model()->findByPk($block)->html_block;
    }




    public static function getTaskCondition($block){
        return strip_tags(LectureElement::model()->findByPk($block)->html_block);
    }
}