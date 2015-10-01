<?php
/**
 * Created by PhpStorm.
 * User: Ivanna
 * Date: 30.05.2015
 * Time: 1:54
 */

class ModuleHelper {

    public static function getDiscountedPrice($price, $discount){
        if ($discount == 0){
            return $price;
        }
        return round($price*(1-$discount/100),2);
    }

    public static function getTeacherModules($teacher, $modules){
        $result = [];
        for($i = 0; $i < count($modules); $i++){
            if ($id = TeacherModule::model()->exists('idTeacher=:teacher AND idModule=:module', array(
                ':teacher' => $teacher,
                ':module' => $modules[$i],
            ))){
                array_push($result, $modules[$i]);
            }
        }
        return $result;
    }

    public static function getModuleName($id){
        $lang = (Yii::app()->session['lg'])?Yii::app()->session['lg']:'ua';

        $title = "title_".$lang;
        $moduleTitle = Module::model()->findByPk($id)->$title;
        if ($moduleTitle == ""){
            $moduleTitle = Module::model()->findByPk($id)->title_ua;
        }
        return $moduleTitle;
    }

    public static function getModuleOrder($id){
        return Module::model()->findByPk($id)->order;
    }
    public static function getModuleDuration($countless,$hours,$hInDay,$daysInWeek){
        if ($countless == 0){
            return 0;
        }
        return ", ".Yii::t('module', '0217')." - <b>".ceil($hours/($hInDay*$daysInWeek))." ".Yii::t('module', '0218')."</b> (".$hInDay." ".Yii::t('module', '0219').", ".$daysInWeek." ".Yii::t('module', '0220').")";
    }
    public static function getModulePrice($price, $isCourse){
        if ($price == 0){
            return '<span class="colorGreen">'.Yii::t('module', '0421').'<span>';
        }
        $result = '<span id="oldPrice">'.$price.' '.Yii::t('module', '0222').'</span> '.ModuleHelper::getDiscountedPrice($price, 50).Yii::t('module', '0222');
        if($isCourse){
            return $result.'('.Yii::t('module', '0223').')';
        } else {
            return $result;
        }
    }

    public static function getModuleTitleParam(){
        $lang = (Yii::app()->session['lg'])?Yii::app()->session['lg']:'ua';
        $title = "title_".$lang;
        return $title;
    }
    public static function getDefaultModuleName($moduleName){
        $lang = (Yii::app()->session['lg'])?Yii::app()->session['lg']:'ua';
        $title = "title_".$lang;

        if ($moduleName == "")
            return 'title_ua';
        else return $title;
    }
    public static function getCourseOfModule($moduleId){
        if (CourseModules::model()->exists('id_module=:id', array(':id' => $moduleId))){
            $courseId = CourseModules::model()->find('id_module ='.$moduleId)->id_course;
            return $courseId;
        } else{
            return false;
        }
    }

    public static function getModuleLang($idModule){
        return Module::model()->findByPk($idModule)->language;
    }

    public static function getModuleNumber($idModule){
        return Module::model()->findByPk($idModule)->module_number;
    }

    public static function getPriceUah($summa){
        return round($summa * CommonHelper::getDollarExchangeRate(), 2);
    }

    public static function getSummaBySchemaNum($moduleId, $summaNum){
        switch($summaNum){
            case '1':
                $summa = ModuleHelper::getSummaWholeModule($moduleId);
                break;
            case '2':
                $summa = ModuleHelper::getSummaWholeModule($moduleId);
                break;
            case '3':
                $summa = ModuleHelper::getSummaWholeModule($moduleId);
                break;
            case '4':
                $summa = ModuleHelper::getSummaWholeModule($moduleId);
                break;
            case '5':
                $summa = ModuleHelper::getSummaWholeModule($moduleId);
                break;
            case '6':
                $summa = ModuleHelper::getSummaWholeModule($moduleId);
                break;
            case '7':
                $summa = ModuleHelper::getSummaWholeModule($moduleId);
                break;
            case '8':
                $summa = ModuleHelper::getSummaWholeModule($moduleId);
                break;
            default :
                throw new CHttpException(400, 'Неправильно вибрана схема оплати!');
                break;
        }
        return $summa;
    }

    //discount 30 percent - first pay schema
    public static function getSummaWholeModule($idModule){
        return Module::model()->findByPk($idModule)->module_price * 0.7;
    }

    //    $image-іконка проплати, $text - текст проплати, $price- ціна курсу, $discount - знижка
    public static function getModuleFirstPrice($image, $image2, $text, $price,$discount=0){
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
    public static function getModulePricePayments($image, $image2, $price, $number=2,$discount=0,$text=''){
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

    //    $image-іконка проплати, $price-ціна проплати за місяць, $year-на скільки років кредит
    public static function getModulePriceCredit($image, $image2, $price=0, $year=2){
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

    //    $image-іконка проплати, $text - текст проплати, $price-ціна проплати за місяць, $number - кількість проплат
    public static function getModulePriceMonths($image, $image2, $text, $price=0,$months=12){
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
}