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
                break;
            case 'junior':
                $level = Yii::t('courses', '0233');
                 break;
            case 'strong junior':
                $level = Yii::t('courses', '0234');
                break;
            case 'middle':
                $level = Yii::t('courses', '0235');
                break;
            case 'senior':
                $level = Yii::t('courses', '0236');
                break;
        }
        return $level;
    }

    public static function getCourseLevel($idCourse){
        $level = Course::model()->findByPk($idCourse)->level;
        return CourseHelper::translateLevel($level);
    }

    public static function translateLevelUa($course){
        $level = Course::model()->findByPk($course)->level;
        switch ($level){
            case 'intern':
                $level = 'стажер';
                break;
            case 'junior':
                $level = 'початківець';
                break;
            case 'strong junior':
                $level = 'сильний початківець';
                break;
            case 'middle':
                $level = 'середній';
                break;
            case 'senior':
                $level = 'високий';
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
                            <div class="numbers"><span class="coursePriceStatus">'.$price." ".Yii::t('courses', '0322').'</span>&nbsp<span class="coursePriceStatus2">'.ModuleHelper::getDiscountedPrice($price, $discount)." ".Yii::t('courses', '0322').'=</span><span> '.ModuleHelper::getDiscountedPrice($price, $discount)/$number.' '.Yii::t('courses', '0322').' x '.$number.' '.Yii::t('course', '0323').'</span></div>
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
                           <div class="numbers"><span>'.$price.' '.Yii::t('courses', '0322').'/'.Yii::t('module', '0218').' х '.(12*$year).' '.Yii::t('course', '0324').' <b>= '.round($price*12*$year).' '.Yii::t('courses', '0322').'</b></span></div>
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

    public static function getCourseLang($id){
        return Course::model()->findByPk($id)->language;
    }

    public static function getCourseTitlesList(){
        $criteria = new CDbCriteria();
        $criteria->select = 'course_ID, title_ua';
        $criteria->distinct = true;
        $criteria->toArray();

        $result = '';
        $titles = Course::model()->findAll($criteria);
        for($i = 0; $i < count($titles); $i++){
            $result[$i][$titles[$i]['course_ID']] = $titles[$i]['title_ua'];
        }
        return $result;
    }

    public static function getCourseNumber($id){
        return Course::model()->findByPk($id)->course_number;
    }

    public static function getPriceUah($summa){
       return round($summa * 22);//CommonHelper::getDollarExchangeRate(), 2);
    }

    public static function getSummaBySchemaNum($courseId, $summaNum){
        switch($summaNum){
            case '1':
                $summa = CourseHelper::getSummaWholeCourse($courseId);
                break;
            case '2':
                $summa = CourseHelper::getSummaCourseTwoPays($courseId);
                break;
            case '3':
                $summa = CourseHelper::getSummaCourseFourPays($courseId);
                break;
            case '4':
                $summa = CourseHelper::getSummaCourseMonthly($courseId);
                break;
            case '5':
                $summa = CourseHelper::getSummaCourseCreditTwoYears($courseId);
                break;
            case '6':
                $summa = CourseHelper::getSummaCourseCreditThreeYears($courseId);
                break;
            case '7':
                $summa = CourseHelper::getSummaCourseCreditFourYears($courseId);
                break;
            case '8':
                $summa = CourseHelper::getSummaCourseCreditFiveYears($courseId);
                break;
            default :
                throw new CHttpException(400, 'Неправильно вибрана схема оплати!');
                break;
        }
        return $summa;
    }

    //discount 30 percent - first pay schema
    public static function getSummaWholeCourse($idCourse){
        return round(Course::model()->findByPk($idCourse)->course_price * 0.7);
    }

    //discount 10 percent - second pay schema
    public static function getSummaCourseTwoPays($idCourse){
        $discountedSumma = Course::model()->findByPk($idCourse)->course_price * 0.9;
        $toPay = round($discountedSumma / 2);
        return $toPay;
    }

    //discount 8 percent - third pay schema
    public static function getSummaCourseFourPays($idCourse){
        $discountedSumma = Course::model()->findByPk($idCourse)->course_price * 0.92;
        $toPay = round($discountedSumma / 2);
        return $toPay;
    }

    //monthly - forth pay schema
    public static function getSummaCourseMonthly($idCourse){
        $toPay = round(Course::model()->findByPk($idCourse)->course_price / 12);
        return $toPay;
    }

    //credit two years - fifth pay schema
    public static function getSummaCourseCreditTwoYears($idCourse){
        $toPay = round(Course::model()->findByPk($idCourse)->course_price / 24);
        return $toPay;
    }

    //credit three years - sixth pay schema
    public static function getSummaCourseCreditThreeYears($idCourse){
        $toPay = round(Course::model()->findByPk($idCourse)->course_price / 36);
        return $toPay;
    }

    //credit four years - seventh pay schema
    public static function getSummaCourseCreditFourYears($idCourse){
        $toPay = round(Course::model()->findByPk($idCourse)->course_price / 48);
        return $toPay;
    }

    //credit five years - eight pay schema
    public static function getSummaCourseCreditFiveYears($idCourse){
        $toPay = round(Course::model()->findByPk($idCourse)->course_price / 60);
        return $toPay;
    }

}