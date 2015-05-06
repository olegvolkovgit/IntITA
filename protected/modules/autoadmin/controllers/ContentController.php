<?php
/**
 * Created by PhpStorm.
 * User: Ivanna
 * Date: 06.05.2015
 * Time: 15:40
 */

class ContentController extends Controller{

    public function actionCoursesList()
    {
        $this->pageTitle = 'Список курсів';
        $this->module->tableName('course');
        $this->module->setPK('course_ID');
        $fieldsConf = array(
            array('course_name', 'string', 'Назва', array('show')),
            array('language', 'string', 'Мова', array('show')),
            array('alias', 'string', 'Аліас', array('show')),
            array('level', 'string', 'Рівень', array('show')),
            array('status', 'num', 'Стан', array('show')),
            array('modules_count', 'num', 'Кількість модулів', array('show')),
            array('course_price', 'num', 'Ціна', array('show')),
            array('course_img', 'image', 'Фото', array('show', 'directoryPath'=>'./')),
            array('start', 'date', 'Початок', array('show')),
            array('for_whom', 'text', 'Для кого', array('show', 'directoryPath'=>'./')),
            array('what_you_learn', 'text', 'Чому ти навчишся', array('show', 'directoryPath'=>'./')),
            array('what_you_get', 'text', 'Що ти отримаєш', array('show', 'directoryPath'=>'./')),
            array('review', 'text', 'Короткий опис', array('show', 'directoryPath'=>'./')),
        );
        $this->module->fieldsConf($fieldsConf);
        $this->module->sortDefault(array('course_name'));
        $this->module->process();
    }
}