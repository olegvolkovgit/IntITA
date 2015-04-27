<?php
/**
 * Created by PhpStorm.
 * User: Ivanna
 * Date: 25.04.2015
 * Time: 2:01
 */

if (true){
    $teacher = Teacher::model()->findByPk($_POST['id']);
    switch ($_POST['property']) {
        case 'firstName':
            $teacher->first_name = $_POST['content'];
            break;
        case 'middleName':
            $teacher->first_name = $_POST['content'];
            break;
        case 'lastName':
            $teacher->first_name = $_POST['content'];
            break;
        case 'sections':
            $teacher->first_name = $_POST['content'];
            break;
        case 'profileTextFirst':
            $teacher->first_name = $_POST['content'];
            break;
        case 'txtMsgFirst':
            $teacher->profile_text_last = $_POST['content'];
            break;
        case 'subjects':
            $teacher->first_name = $_POST['content'];
            break;
    }
    $teacher->save();
}