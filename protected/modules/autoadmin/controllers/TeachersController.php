<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 13.03.2015
 * Time: 17:26
 */

class TeachersController  extends Controller
{

    public function actionList()
    {
        $this->pageTitle = 'Список викладачів';
        $this->module->tableName('teacher');
        $this->module->setPK('teacher_id');
        $fieldsConf = array(
            array('last_name', 'string', 'Прізвище', array('show')),
            array('first_name', 'string', 'Ім\'я', array('show')),
            array('middle_name', 'string', 'По-батькові', array('show')),
            array('foto_url_short', 'image', 'Фото', array('show', 'directoryPath'=>'/IntITA/css/images/')),
            array('subjects', 'text', 'Веде курси', array('show', 'directoryPath'=>'./')),
            array('profile_text_short', 'text', 'Профіль (коротко)', array('show', 'directoryPath'=>'./')),
            array('profile_text_first', 'text', 'Профіль викладача (блок 1)', array('show', 'directoryPath'=>'./')),
            array('profile_text_last', 'text', 'Профіль викладача (блок 2)', array('show', 'directoryPath'=>'./')),
        );
        $this->module->fieldsConf($fieldsConf);
        $this->module->sortDefault(array('last_name'));
        $this->module->process();
    }
}