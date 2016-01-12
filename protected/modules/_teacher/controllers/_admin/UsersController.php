<?php
/**
 * Created by PhpStorm.
 * User: Ivanna
 * Date: 12.01.2016
 * Time: 13:31
 */

class UsersController extends TeacherCabinetController
{
    public function actionIndex()
    {
        $this->renderPartial('index',array(),false,true);
    }


}