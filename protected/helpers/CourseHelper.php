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
    public static function getMainCoursePrice($price,$discount=0){
        if ($price == 0){
            return '<span class="colorGreen">'.Yii::t('module', '0421').'<span>';
        }
        if ($discount == 0){
            return '<span id="coursePriceStatus2">'.$price." ".Yii::t('courses', '0322').'</span>';
        }
        return '<span id="coursePriceStatus1">'.$price." ".Yii::t('courses', '0322').'</span>&nbsp<span id="coursePriceStatus2">'.ModuleHelper::getDiscountedPrice($price, $discount)." ".Yii::t('courses', '0322').'</span><span id="discount"> ('.Yii::t('courses', '0144').' - '.$discount.'%)</span>';
    }
    //    $image-іконка проплати, $text - текст проплати, $price- ціна курсу, $discount - знижка
    public static function getCoursePrice($image, $image2, $text, $price,$discount=0){
        if ($price == 0){
            return '<span style="display: inline-block;margin-top: 3px" class="colorGreen">'.Yii::t('module', '0421').'<span>';
        }
        if ($discount == 0){
            return
                '<table class="mainPay">
                    <tr>
                    <td class="icoPay"><img class="icoNoCheck" src="'.$image.'"><img class="icoCheck" src="'.$image2.'"></td>
                    <td>
                        <table>
                            <tr><td><div>'.$text.'</div></td></tr>
                            <tr><td><span class="coursePriceStatus2">'.$price." ".Yii::t('courses', '0322').'</span></td></tr>
                        </table>
                    </td>
                    </tr>
                </table>';
        }
        return
            '<table class="mainPay">
                <tr>
                <td class="icoPay"><img class="icoNoCheck" src="'.$image.'"><img class="icoCheck" src="'.$image2.'"></td>
                <td>
                    <table>
                        <tr><td><div>'.Yii::t('course', '0197').'</div></td></tr>
                        <tr><td>
                            <div class="numbers"><span class="coursePriceStatus1">'.$price." ".Yii::t('courses', '0322').'</span>
                            &nbsp<span class="coursePriceStatus2">'.ModuleHelper::getDiscountedPrice($price, $discount)." ".Yii::t('courses', '0322').'</span><br>
                            <span id="discount"> <img style="text-align:right" src="'.StaticFilesHelper::createPath('image', 'course', 'pig.png').'">('.Yii::t('courses', '0144').' - '.$discount.'%)</span>
                            </div>
                        </td></tr>
                    </table>
                </td>
                </tr>
            </table>';
    }
    //    $price-ціна курсу, $number - кількість проплат, $discount - знижка
    public static function getCoursePricePayments($image, $image2, $price, $number=2,$discount=0,$text=''){
        if ($price == 0){
            return '<span style="display: inline-block;margin-top: 3px" class="colorGreen">'.Yii::t('module', '0421').'<span>';
        }
        if ($discount == 0){
            return
                '<table class="mainPay">
                    <tr>
                    <td class="icoPay"><img class="icoNoCheck" src="'.$image.'"><img class="icoCheck" src="'.$image2.'"></td>
                    <td>
                        <table>
                            <tr><td><div style="color:#4b75a4">'.$number.' '.Yii::t('course', '0198').'</div></td></tr>
                            <tr><td>
                                <div class="numbers"><span class="coursePriceStatus">'.$price." ".Yii::t('courses', '0322').'</span>= '.$price/$number.' '.Yii::t('courses', '0322').'</div>
                            </td></tr>
                        </table>
                    </td>
                    </tr>
                </table>';
        }
        return
            '<table class="mainPay">
                <tr>
                <td class="icoPay"><img class="icoNoCheck" src="'.$image.'"><img class="icoCheck" src="'.$image2.'"></td>
                <td>
                    <table>
                        <tr><td><div style="color:#4b75a4">'.$number.' '.Yii::t('course', '0198').'</div></td></tr>
                        <tr><td>
                            <div class="numbers"><span class="coursePriceStatus">'.$price." ".Yii::t('courses', '0322').'</span>&nbsp<span>'.ModuleHelper::getDiscountedPrice($price, $discount)." ".Yii::t('courses', '0322').'=</span><span class="coursePriceStatus2"> '.ModuleHelper::getDiscountedPrice($price, $discount)/$number.' '.Yii::t('courses', '0322').'</span></div>
                            <span id="discount"> <img style="text-align:right" src="'.StaticFilesHelper::createPath('image', 'course', 'pig.png').'">('.Yii::t('courses', '0144').' - '.$discount.'%)</span>
                        </td></tr>
                    </table>
                </td>
                </tr>
            </table>';
    }
    //    $image-іконка проплати, $text - текст проплати, $price-ціна проплати за місяць, $number - кількість проплат
    public static function getCoursePriceMonths($image, $image2, $text, $price=0,$months=12){
        if ($price == 0){
            return '<span style="display: inline-block;margin-top: 3px" class="colorGreen">'.Yii::t('module', '0421').'<span>';
        }
        return
            '<table class="mainPay">
                <tr>
                <td class="icoPay"><img class="icoNoCheck" src="'.$image.'"><img class="icoCheck" src="'.$image2.'"></td>
                <td>
                    <table>
                        <tr><td><div>'.$text.'</div></td></tr>
                        <tr><td>
                           <div class="numbers"><span>'.$price.' '.Yii::t('courses', '0322').'/'.Yii::t('module', '0218').' х '.$months.' '.Yii::t('course', '0323').'<b> = '.$price*$months.' '.Yii::t('courses', '0322').'</b></span></div>
                        </td></tr>
                    </table>
                </td>
                </tr>
            </table>';
    }
    //    $image-іконка проплати, $price-ціна проплати за місяць, $year-на скільки років кредит
    public static function getCoursePriceCredit($image, $image2, $price=0, $year=2){
        if ($price == 0){
            return '<span style="display: inline-block;margin-top: 3px" class="colorGreen">'.Yii::t('module', '0421').'<span>';
        }
        return
            '<table class="mainPay">
                <tr>
                <td class="icoPay"><img class="icoNoCheck" src="'.$image.'"><img class="icoCheck" src="'.$image2.'"></td>
                <td>
                    <table>
                        <tr><td><div>'.Yii::t('course', '0425').' '.$year.' '.Yii::t('course', '0426').'</div></td></tr>
                        <tr><td>
                           <div class="numbers"><span>'.$price.' '.Yii::t('courses', '0322').'/'.Yii::t('module', '0218').' х '.(12*$year).' '.Yii::t('course', '0324').' <b>= '.$price*12*$year.' '.Yii::t('courses', '0322').'</b></span></div>
                        </td></tr>
                    </table>
                </td>
                </tr>
            </table>';
    }

    public static function getCourseName($idCourse){
        $lang = (Yii::app()->session['lg'])?Yii::app()->session['lg']:'ua';

        $title = "title_".$lang;
        $courseTitle = Course::model()->findByPk($idCourse)->$title;
        return $courseTitle;
    }

    public static function getLangParam(){
        $lang = (Yii::app()->session['lg'])?Yii::app()->session['lg']:'ua';
        return $lang;
    }
    public static function getLessonsCount($id){
        $criteria=new CDbCriteria;
        $criteria->alias='course_modules';
        $criteria->addCondition('id_course='.$id);
        $modules = CourseModules::model()->findAll($criteria);
        $modulesId = [];
        foreach($modules as $module){
            array_push($modulesId, $module->id_module);
        }

        $criteria2=new CDbCriteria;
        $criteria2->alias='module';
        $criteria2->addInCondition('module_ID', $modulesId, 'OR');
        $modulesInfo = Module::model()->findAll($criteria2);
        $lessonsCount=0;
        foreach($modulesInfo as $modul){
            $lessonsCount=$lessonsCount+$modul->lesson_count;
        }

        return $lessonsCount;
    }
}