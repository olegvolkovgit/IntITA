<?php
/**
 * Created by PhpStorm.
 * User: Ivanna
 * Date: 10.06.2015
 * Time: 17:01
 */

class CourseHelper {
    public static function translateLevel($level){
        switch ($level){
            case 'intern':
                $level = Yii::t('courses', '0232');
                //$rate = 1;
                break;
            case 'junior':
                $level = Yii::t('courses', '0233');
                //$rate = 2;
                break;
            case 'strong junior':
                $level = Yii::t('courses', '0234');
                //$rate = 3;
                break;
            case 'middle':
                $level = Yii::t('courses', '0235');
                //$rate = 4;
                break;
            case 'senior':
                $level = Yii::t('courses', '0236');
                //$rate = 5;
                break;
        }
        return $level;
    }

    public static function getCourseRate($level){
        $rate = 0;
        switch ($level){
            case 'intern':
                $rate = 1;
                break;
            case 'junior':
                $rate = 2;
                break;
            case 'strong junior':
                $rate = 3;
                break;
            case 'middle':
                $rate = 4;
                break;
            case 'senior':
                $rate = 5;
                break;
        }
        return $rate;
    }

    public static function getCoursePrice($price,$discount=0){
        if ($price == 0){
            return '<span class="colorGreen">'.Yii::t('module', '0421').'<span>';
        }
        if ($discount == 0){
            return '<span id="coursePriceStatus2">'.$price." ".Yii::t('courses', '0322').'</span>';
        }
        return '<span id="coursePriceStatus1">'.$price." ".Yii::t('courses', '0322').'</span>&nbsp<span id="coursePriceStatus2">'.ModuleHelper::getDiscountedPrice($price, $discount)." ".Yii::t('courses', '0322').'</span><span id="discount"> ('.Yii::t('courses', '0144').' - '.$discount.'%)</span>';
    }
    //    $price-ціна курсу, $number - кількість проплат, $discount - знижка
    public static function getCoursePricePayments($price=0,$number=2,$discount=0){
        if ($price == 0 || $number==0){
            return;
        }
        if ($discount == 0){
            return '<div>'.$number.' '.Yii::t('course', '0198').'</div><div class="numbers"><span id="coursePriceStatus2">'.$price." ".Yii::t('courses', '0322').' =</span> '.$price/$number.' '.Yii::t('courses', '0322').' x '.$number.' '.Yii::t('course', '0323').'</div>';
        }
        return '<div>'.$number.' '.Yii::t('course', '0198').'</div><div class="numbers"><span id="coursePriceStatus1">'.$price." ".Yii::t('courses', '0322').'</span>&nbsp<span id="coursePriceStatus2">'.ModuleHelper::getDiscountedPrice($price, $discount)." ".Yii::t('courses', '0322').'=</span> '.ModuleHelper::getDiscountedPrice($price, $discount)/$number.' '.Yii::t('courses', '0322').' x '.$number.' '.Yii::t('course', '0323').'<span id="discount"> ('.Yii::t('courses', '0144').' - '.$discount.'%)</span></div>';
    }
    //    $price-ціна проплати за місяць, $number - кількість проплат
    public static function getCoursePriceMonths($price=0,$months=12){
        if ($price == 0){
            return;
        }
        if ($months <= 12){
            return '<div>'.Yii::t('course', '0200').'</div><div class="numbers"><span>'.$price.' '.Yii::t('courses', '0322').'/'.Yii::t('module', '0218').' х '.$months.' '.Yii::t('course', '0323').'<b> = '.$price*$months.' '.Yii::t('courses', '0322').'</b></span></div>';
        }
    }
    //    $price-ціна проплати за місяць, $year-на скільки років кредит
    public static function getCoursePriceCredit($price=0, $year=2){
        if ($price == 0){
            return;
        }
        return '<div>'.Yii::t('course', '0425').' '.$year.' '.Yii::t('course', '0426').'</div><div class="numbers"><span>'.$price.' '.Yii::t('courses', '0322').'/'.Yii::t('module', '0218').' х '.(12*$year).' '.Yii::t('course', '0324').' <b>= '.$price*12*$year.' '.Yii::t('courses', '0322').'</b></span></div>';
    }
}