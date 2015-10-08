<?php
/**
 * Created by PhpStorm.
 * User: Ivanna
 * Date: 30.05.2015
 * Time: 1:54
 */
class ModuleHelper
{

    public static function getDiscountedPrice($price, $discount)
    {
        if ($discount == 0) {
            return $price;
        }
        return round($price * (1 - $discount / 100), 2);
    }

    public static function getTeacherModules($teacher, $modules)
    {
        $result = [];
        for ($i = 0; $i < count($modules); $i++) {
            if ($id = TeacherModule::model()->exists('idTeacher=:teacher AND idModule=:module', array(
                ':teacher' => $teacher,
                ':module' => $modules[$i],
            ))
            ) {
                array_push($result, $modules[$i]);
            }
        }
        return $result;
    }

    public static function getModuleName($id)
    {
        $lang = (Yii::app()->session['lg']) ? Yii::app()->session['lg'] : 'ua';

        $title = "title_" . $lang;
        $moduleTitle = Module::model()->findByPk($id)->$title;
        if ($moduleTitle == "") {
            $moduleTitle = Module::model()->findByPk($id)->title_ua;
        }
        return $moduleTitle;
    }

    public static function getModuleOrder($id)
    {
        return Module::model()->findByPk($id)->order;
    }

    public static function getModuleDuration($countless, $hours, $hInDay, $daysInWeek)
    {
        if ($countless == 0) {
            return 0;
        }
        return ", " . Yii::t('module', '0217') . " - <b>" . round($countless * 7 / ($hInDay * $daysInWeek)) . " " . Yii::t('module', '0218') . "</b> (" . $hInDay . " " . Yii::t('module', '0219') . ", " . $daysInWeek . " " . Yii::t('module', '0220') . ")";
    }

    public static function getModulePrice($price, $isCourse)
    {
        if ($price == 0) {
            return '<span class="colorGreen">' . Yii::t('module', '0421') . '<span>';
        }
        $result = '<span id="oldPrice">' . $price . ' ' . Yii::t('module', '0222') . '</span> ' . ModuleHelper::getDiscountedPrice($price, 50) . Yii::t('module', '0222');
        if ($isCourse) {
            return $result . '(' . Yii::t('module', '0223') . ')';
        } else {
            return $result;
        }
    }

    public static function getModuleTitleParam()
    {
        $lang = (Yii::app()->session['lg']) ? Yii::app()->session['lg'] : 'ua';
        $title = "title_" . $lang;
        return $title;
    }

    public static function getDefaultModuleName($moduleName)
    {
        $lang = (Yii::app()->session['lg']) ? Yii::app()->session['lg'] : 'ua';
        $title = "title_" . $lang;

        if ($moduleName == "")
            return 'title_ua';
        else return $title;
    }

    public static function getCourseOfModule($moduleId)
    {
        if (CourseModules::model()->exists('id_module=:id', array(':id' => $moduleId))) {
            $courseId = CourseModules::model()->find('id_module =' . $moduleId)->id_course;
            return $courseId;
        } else {
            return false;
        }
    }

    public static function getModuleLang($idModule)
    {
        return Module::model()->findByPk($idModule)->language;
    }

    public static function getModuleNumber($idModule)
    {
        return Module::model()->findByPk($idModule)->module_number;
    }

    public static function getPriceUah($summa){
        return round($summa * 22);//CommonHelper::getDollarExchangeRate());
    

    public static function getModuleSumma($moduleId, $isIndependent = false)
    {
        if ($isIndependent) {
            return Module::model()->findByPk($moduleId)->module_price * (1 + Config::getCoeffIndependentModule());
        } else {
            return round(Module::model()->findByPk($moduleId)->module_price);
        }
    }

    public static function getModulePricePayment($image, $image2, $text, $price, $discount = 0, $isIndependent)
    {
        if ($price == 0) {
            return '<span style="display: inline-block;margin-top: 3px" class="colorGreen">' . Yii::t('module', '0421') . '<span>';
        }
        if ($isIndependent) {
            $price = $price * (1 + Config::getCoeffIndependentModule());
        }
        if ($discount == 0) {
            return
                '<table class="mainPay">
                    <tr>
                    <td class="icoPay"><img class="icoNoCheck" src="' . $image . '"><img class="icoCheck" src="' . $image2 . '"></td>
                    <td>
                        <table>
                            <tr><td><div>' . $text . '</div></td></tr>
                            <tr><td><span class="coursePriceStatus2">' . $price . " " . Yii::t('courses', '0322') . '</span></td></tr>
                        </table>
                    </td>
                    </tr>
                </table>';
        }
        return
            '<table class="mainPay">
                <tr>
                <td class="icoPay"><img class="icoNoCheck" src="' . $image . '"><img class="icoCheck" src="' . $image2 . '"></td>
                <td>
                    <table>
                        <tr><td><div>' . Yii::t('course', '0197') . '</div></td></tr>
                        <tr><td>
                            <div class="numbers"><span class="coursePriceStatus1">' . $price . " " . Yii::t('courses', '0322') . '</span>
                            &nbsp<span class="coursePriceStatus2">' . ModuleHelper::getDiscountedPrice($price, $discount) . " " . Yii::t('courses', '0322') . '</span><br>
                            <span id="discount"> <img style="text-align:right" src="' . StaticFilesHelper::createPath('image', 'course', 'pig.png') . '">(' . Yii::t('courses', '0144') . ' - ' . $discount . '%)</span>
                            </div>
                        </td></tr>
                    </table>
                </td>
                </tr>
            </table>';
    }

    public static function getAverageModuleDuration($lesson_count, $hours_in_day, $days_in_week)
    {
        return round($lesson_count * 7 / ($hours_in_day * $days_in_week));
    }

    public static function getModuleProgress($module_ID, $user)
    {
        /*find lecture id*/
        $firstLectureId = LectureHelper::getFirstLectureID($module_ID);
        $lastLectureId = LectureHelper::getLastLectureID($module_ID);

        if ($firstLectureId && $lastLectureId) {
            $firstQuiz = LectureHelper::getFirstQuiz($firstLectureId);
            $lastQuiz = LectureHelper::getLastQuiz($lastLectureId);
        } else {
            $moduleStatus=array('inline', 0);
            return $moduleStatus;
        }
        if ($firstQuiz) $startTime = ModuleHelper::getModuleStartTime($firstQuiz, $user); else $startTime = false;
        if ($lastQuiz) $endTime = ModuleHelper::getModuleFinishedTime($lastQuiz, $user); else $endTime = false;

        if (!$startTime) {
            $moduleStatus=array('inline', 0);
            return $moduleStatus;
        }
        if ($startTime && !$endTime) {
            $days=round((time()-strtotime($startTime))/86400);
            $moduleStatus=array('inProgress', abs($days));
            return $moduleStatus;
        }
        if ($startTime && $endTime) {
            $days=round((strtotime($endTime)-strtotime($startTime))/86400);
            $moduleStatus=array('finished', abs($days));
            return $moduleStatus;
        }
    }

    public static function getModuleStartTime($firstQuiz, $user)
    {
        switch (LectureElement::model()->findByPk($firstQuiz)->id_type) {
            case '5':
            case '6':
                return TaskMarks::taskTime($user, Task::model()->findByAttributes(array('condition' => $firstQuiz))->id);
                break;
            case '12':
            case '13':
                return TestsMarks::testTime($user, Tests::model()->findByAttributes(array('block_element' => $firstQuiz))->id);
                break;
            default:
                return false;
                break;
        }
    }

    public static function getModuleFinishedTime($lastQuiz, $user)
    {
        switch (LectureElement::model()->findByPk($lastQuiz)->id_type) {
            case '5':
            case '6':
                return TaskMarks::taskTime($user, Task::model()->findByAttributes(array('condition' => $lastQuiz))->id);
                break;
            case '12':
            case '13':
                return TestsMarks::testTime($user, Tests::model()->findByAttributes(array('block_element' => $lastQuiz))->id);
                break;
            default:
                return false;
                break;
        }
    }
    public static function getHoursColor($finishedTime, $averageTime)
    {
        if($finishedTime<=$averageTime) return 'greenFinished';
        else return 'redFinished';
    }
}