<?php

/**
 * var $account TempPay
 */
class PaymentHelper
{
    public static function getAccountProductTitle($account){
        if ($account->id_module != null){
            return "Модуль №".Module::model()->findByPk($account->id_module)->module_number.". ".
            Module::model()->findByPk($account->id_module)->title_ua . ', '.
            ModuleHelper::translateLevelUa($account->id_module);
        } else {
            return "Курс №".Course::model()->findByPk($account->id_course)->course_number.". ".
            Course::model()->findByPk($account->id_course)->title_ua . ', '.
            CourseHelper::translateLevelUa($account->id_course);
        }
    }

    public static function getPriceUah($summa)
    {
        return round($summa * 22);//CommonHelper::getDollarExchangeRate(), 2);
    }
}