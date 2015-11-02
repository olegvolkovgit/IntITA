<?php

/**
 * Created by PhpStorm.
 * User: Ivanna
 * Date: 10.06.2015
 * Time: 17:01
 */
class CourseHelper
{
    public static function translateLevel($level)
    {

        if(isset(Yii::app()->session)){$lg = Yii::app()->session['lg'];}else $lg = 'ua';

       switch ($level) {
            case 'intern':
                $level = Messages::getMessagesByLevel('0232',$lg);
                break;
            case 'junior':
                $level = Messages::getMessagesByLevel('0233',$lg);
                break;
            case 'strong junior':
                $level = Messages::getMessagesByLevel('0234',$lg);
                break;
            case 'middle':
                $level = Messages::getMessagesByLevel('0235',$lg);
                break;
            case 'senior':
                $level = Messages::getMessagesByLevel('0236',$lg);
                break;
        }

        return $level;
    }

    public static function getCourseLevel($idCourse)
    {
        $level = Course::model()->findByPk($idCourse)->level;
        return CourseHelper::translateLevel($level);
    }

    public static function translateLevelUa($course)
    {
        $level = Course::model()->findByPk($course)->level;
        return CommonHelper::translateLevelUa($level);
    }

    public static function getCourseRate($level)
    {
        $rate = 0;
        switch ($level) {
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

    public static function getMainCoursePrice($price, $discount = 0)
    {
        if ($price == 0) {
            return '<span class="colorGreen">' . Yii::t('module', '0421') . '</span>';
        }
        if ($discount == 0) {
            return '<span id="coursePriceStatus2">' . $price . " " . Yii::t('courses', '0322') . '</span>';
        }
        return '<span id="coursePriceStatus1">' . $price . " " . Yii::t('courses', '0322') . '</span>&nbsp<span id="coursePriceStatus2">' . ModuleHelper::getDiscountedPrice($price, $discount) . " " . Yii::t('courses', '0322') . '</span><span id="discount"> (' . Yii::t('courses', '0144') . ' - ' . $discount . '%)</span>';
    }

    //    $image-іконка проплати, $text - текст проплати, $price- ціна курсу, $discount - знижка
    public static function getCoursePrice($image, $image2, $text, $price, $discount = 0)
    {
        if ($price == 0) {
            return '<span style="display: inline-block;margin-top: 3px" class="colorGreen">' . Yii::t('module', '0421') . '</span>';
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

    //    $price-ціна курсу, $number - кількість проплат, $discount - знижка
    public static function getCoursePricePayments($image, $image2, $price, $number = 2, $discount = 0)
    {
        if ($price == 0) {
            return '<span style="display: inline-block;margin-top: 3px" class="colorGreen">' . Yii::t('module', '0421') . '</span>';
        }
        if ($discount == 0) {
            return
                '<table class="mainPay">
                    <tr>
                    <td class="icoPay"><img class="icoNoCheck" src="' . $image . '"><img class="icoCheck" src="' . $image2 . '"></td>
                    <td>
                        <table>
                            <tr><td><div style="color:#4b75a4">' . $number . ' ' . Yii::t('course', '0198') . '</div></td></tr>
                            <tr><td>
                                <div class="numbers"><span class="coursePriceStatus">' . $price . " " . Yii::t('courses', '0322') . '</span>= ' . $price / $number . ' ' . Yii::t('courses', '0322') . '</div>
                            </td></tr>
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
                        <tr><td><div style="color:#4b75a4">' . $number . ' ' . Yii::t('course', '0198') . '</div></td></tr>
                        <tr><td>
                            <div class="numbers"><span class="coursePriceStatus">' . $price . " " . Yii::t('courses', '0322') .
            '</span>&nbsp<span class="coursePriceStatus2">' . ModuleHelper::getDiscountedPrice($price, $discount) . " " .
            Yii::t('courses', '0322') . '=</span><span> ' . round(ModuleHelper::getDiscountedPrice($price, $discount) / $number) .
            ' ' . Yii::t('courses', '0322') . ' x ' . $number . ' ' . Yii::t('course', '0323') . '</span></div>
                            <span id="discount"> <img style="text-align:right" src="' . StaticFilesHelper::createPath('image', 'course', 'pig.png') .
            '">(' . Yii::t('courses', '0144') . ' - ' . $discount . '%)</span>
                        </td></tr>
                    </table>
                </td>
                </tr>
            </table>';
    }

    //    $image-іконка проплати, $text - текст проплати, $price-ціна проплати за місяць, $number - кількість проплат
    public static function getCoursePriceMonths($image, $image2, $text, $price = 0, $months = 12, $idCourse)
    {
        if ($price == 0) {
            return '<span style="display: inline-block;margin-top: 3px" class="colorGreen">' . Yii::t('module', '0421') . '</span>';
        }
        return
            '<table class="mainPay">
                <tr>
                <td class="icoPay"><img class="icoNoCheck" src="' . $image . '"><img class="icoCheck" src="' . $image2 . '"></td>
                <td>
                    <table>
                        <tr><td><div>' . $text . '</div></td></tr>
                        <tr><td>
                           <div class="numbers"><span>' . $price . ' ' . Yii::t('courses', '0322') . '/' .
            Yii::t('module', '0218') . ' х ' . $months . ' ' . Yii::t('course', '0323') . '<b> = ' .
            CourseHelper::getSummaBySchemaNum($idCourse, 4, true) . ' ' . Yii::t('courses', '0322') . '</b></span></div>
                        </td></tr>
                    </table>
                </td>
                </tr>
            </table>';
    }

    //    $image-іконка проплати, $price-ціна проплати за місяць, $year-на скільки років кредит
    public static function getCoursePriceCredit($image, $image2, $price = 0, $year = 2, $idCourse)
    {
        $price = round($price);
        if ($price == 0) {
            return '<span style="display: inline-block;margin-top: 3px" class="colorGreen">' . Yii::t('module', '0421') . '</span>';
        }
        return
            '<table class="mainPay">
                <tr>
                <td class="icoPay"><img class="icoNoCheck" src="' . $image . '"><img class="icoCheck" src="' . $image2 . '"></td>
                <td>
                    <table>
                        <tr><td><div>' . Yii::t('course', '0425') . ' ' . $year . ' ' . CommonHelper::getYearsTermination($year) . '</div></td></tr>
                        <tr><td>
                           <div class="numbers"><span>' . $price . ' ' . Yii::t('courses', '0322') . '/' .
            Yii::t('module', '0218') . ' х ' . (12 * $year) . ' ' . Yii::t('course', '0324') . ' <b>= ' .
            round(CourseHelper::getCreditCoursePrice($idCourse, $year)) . ' ' . Yii::t('courses', '0322') . '</b></span></div>
                        </td></tr>
                    </table>
                </td>
                </tr>
            </table>';
    }

    public static function getCourseName($idCourse)
    {
        $lang = (Yii::app()->session['lg']) ? Yii::app()->session['lg'] : 'ua';
        $title = "title_" . $lang;
        $courseTitle = Course::model()->findByPk($idCourse)->$title;
        return $courseTitle;
    }

    public static function getLangParam()
    {
        $lang = (Yii::app()->session['lg']) ? Yii::app()->session['lg'] : 'ua';
        return $lang;
    }

    public static function getLessonsCount($id)
    {
        $criteria = new CDbCriteria;
        $criteria->alias = 'course_modules';
        $criteria->addCondition('id_course=' . $id);
        $modules = CourseModules::model()->findAll($criteria);
        $modulesId = [];
        foreach ($modules as $module) {
            array_push($modulesId, $module->id_module);
        }

        $criteria2 = new CDbCriteria;
        $criteria2->alias = 'module';
        $criteria2->addInCondition('module_ID', $modulesId, 'OR');
        $modulesInfo = Module::model()->findAll($criteria2);
        $lessonsCount = 0;
        foreach ($modulesInfo as $modul) {
            $lessonsCount = $lessonsCount + $modul->lesson_count;
        }

        return $lessonsCount;
    }

    public static function getCourseLang($id)
    {
        return Course::model()->findByPk($id)->language;
    }

    public static function getCourseTitlesList()
    {
        $criteria = new CDbCriteria();
        $criteria->select = 'course_ID, title_ua';
        $criteria->distinct = true;
        $criteria->toArray();

        $result = '';
        $titles = Course::model()->findAll($criteria);
        for ($i = 0; $i < count($titles); $i++) {
            $result[$i][$titles[$i]['course_ID']] = $titles[$i]['title_ua'];
        }
        return $result;
    }

    public static function getCourseNumber($id)
    {
        return Course::model()->findByPk($id)->course_number;
    }

    public static function getPriceUah($summa)
    {
        return round($summa * 22);//CommonHelper::getDollarExchangeRate(), 2);
    }

    public static function getSummaBySchemaNum($courseId, $summaNum, $isWhole = false)
    {
        switch ($summaNum) {
            case '1':
                $summa = CourseHelper::getSummaWholeCourse($courseId);
                break;
            case '2':
                $summa = CourseHelper::getSummaCourseTwoPays($courseId, $isWhole);
                break;
            case '3':
                $summa = CourseHelper::getSummaCourseFourPays($courseId, $isWhole);
                break;
            case '4':
                $summa = CourseHelper::getSummaCourseMonthly($courseId, $isWhole);
                break;
            case '5':
                $summa = CourseHelper::getSummaCourseCreditTwoYears($courseId, $isWhole);
                break;
            case '6':
                $summa = CourseHelper::getSummaCourseCreditThreeYears($courseId, $isWhole);
                break;
            case '7':
                $summa = CourseHelper::getSummaCourseCreditFourYears($courseId, $isWhole);
                break;
            case '8':
                $summa = CourseHelper::getSummaCourseCreditFiveYears($courseId, $isWhole);
                break;
            default :
                throw new CHttpException(400, 'Неправильно вибрана схема оплати!');
                break;
        }
        return $summa;
    }

    public static function getCreditCoursePrice($idCourse, $years)
    {
        $modules = Yii::app()->db->createCommand("SELECT id_module FROM course_modules WHERE id_course =" . $idCourse
        )->queryAll();
        $summa = 0;
        for ($i = 0, $count = count($modules); $i < $count; $i++) {
            $summa += (integer)Module::model()->findByPk($modules[$i]["id_module"])->module_price;
        }
        $toPaySumma = $summa * pow((1 + 0.3), $years);
        return $toPaySumma;
    }

    //discount 30 percent - first pay schema
    public static function getSummaWholeCourse($idCourse)
    {
        return round(Course::getCoursePrice($idCourse) * 0.7);
    }

    //discount 10 percent - second pay schema
    public static function getSummaCourseTwoPays($idCourse, $isWhole)
    {
        $discountedSumma = Course::getCoursePrice($idCourse) * 0.9;
        if ($isWhole) {
            return $discountedSumma;
        }
        $toPay = round($discountedSumma / 2);
        return $toPay;
    }

    //discount 8 percent - third pay schema
    public static function getSummaCourseFourPays($idCourse, $isWhole)
    {
        $discountedSumma = Course::getCoursePrice($idCourse) * 0.92;
        if ($isWhole) {
            return $discountedSumma;
        }
        $toPay = round($discountedSumma / 4);
        return $toPay;
    }

    //monthly - forth pay schema
    public static function getSummaCourseMonthly($idCourse, $isWhole)
    {
        $wholePrice = Course::getCoursePrice($idCourse);
        if ($isWhole) {
            return $wholePrice;
        }
        $toPay = round($wholePrice / 12);
        return $toPay;
    }

    //credit two years - fifth pay schema
    public static function getSummaCourseCreditTwoYears($idCourse, $isWhole)
    {
        $wholePrice = CourseHelper::getCreditCoursePrice($idCourse, 2);
        if ($isWhole) {
            return $wholePrice;
        }
        $toPay = round($wholePrice / 24);
        return $toPay;
    }

    //credit three years - sixth pay schema
    public static function getSummaCourseCreditThreeYears($idCourse, $isWhole)
    {
        $wholePrice = CourseHelper::getCreditCoursePrice($idCourse, 3);
        if ($isWhole) {
            return $wholePrice;
        }
        $toPay = round($wholePrice / 36);
        return $toPay;
    }

    //credit four years - seventh pay schema
    public static function getSummaCourseCreditFourYears($idCourse, $isWhole)
    {
        $wholePrice = CourseHelper::getCreditCoursePrice($idCourse, 4);
        if ($isWhole) {
            return $wholePrice;
        }
        $toPay = round($wholePrice / 48);
        return $toPay;
    }

    //credit five years - eight pay schema
    public static function getSummaCourseCreditFiveYears($idCourse, $isWhole)
    {
        $wholePrice = CourseHelper::getCreditCoursePrice($idCourse, 5);
        if ($isWhole) {
            return $wholePrice;
        }
        $toPay = round($wholePrice / 60);
        return $toPay;
    }

    public static function generateModuleCoursesList($idModule,$messages = null)
    {
        if($messages !== null)
        {
            return ;
        }
        $courses = CourseModules::model()->findAllByAttributes(array('id_module' => $idModule));
        $count = count($courses);
        $result = [];
        for ($i = 0; $i < $count; $i++) {
            $result[$i]['id'] = $courses[$i]->id_course;
            $result[$i]['alias'] = CourseHelper::getCourseName($courses[$i]->id_course);
            $result[$i]['language'] = CourseHelper::getCourseLang($courses[$i]->id_course);
            $result[$i]['mandatory'] = $courses[$i]->mandatory_modules;
            $result[$i]['price'] = $courses[$i]->price_in_course;
        }
        return $result;
    }

    public static function printTitle($idCourse,$messages = null)
    {
        $courseHelper = new CourseHelper();
        $chartSchema = $courseHelper->getMessage($messages,'chart');
       return $chartSchema . ' ' . CourseHelper::getCourseName($idCourse).", ".CourseHelper::getCourseLevel($idCourse);
    }

    public static function getMessage($message = null,$type = null)
    {
        if ($message !== null){
        switch($type){
            case 'months' : return $message[0];
            case 'module' : return $message[1];
            case 'trainee' : return $message[2];
            case 'chart' : return $message[3];
            case 'save' ; return $message[4];
        }
        }
        else{
            switch($type)
            {
                case 'months' : return Yii::t('course', '0667');
                case 'module' : return Yii::t('course', '0668');
                case 'trainee' : return Yii::t('course', '0669');
                case 'chart' : return Yii::t('course', '0670');
                case 'save' : return Yii::t('course', '0671');
                case 'exam' : return Yii::t('course','0673');
            }
        }
    }
}