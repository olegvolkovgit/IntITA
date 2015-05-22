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
            array('user_id', 'foreign', 'Користувач', array(
                'show', //Show in List mode
                'search',   //User is allowed to search by this field
                'bindBy'=>'id',
                'foreign'=>array(
                    'show',
                    'table' => 'user',
                    'pk'        => 'id',    //foreign primary key
                    'select'    => array('id'),    //foreign fields to select
                    'order'     => 'id',   //foreign fields to order by
                )
            )),
            array('last_name', 'string', 'Прізвище', array('show')),
            array('first_name', 'string', 'Ім\'я', array('show')),
            array('middle_name', 'string', 'По-батькові', array('show')),
            array('foto_url_short', 'image', 'Фото', array('show', 'directoryPath'=>'/IntITA/css/images/')),
            array('subjects', 'text', 'Веде курси', array('show', 'directoryPath'=>'./')),
            array('profile_text_short', 'text', 'Профіль (коротко)', array('show', 'directoryPath'=>'./')),

        );
        $this->module->fieldsConf($fieldsConf);
        $this->module->sortDefault(array('last_name'));
        $this->module->process();
    }
}