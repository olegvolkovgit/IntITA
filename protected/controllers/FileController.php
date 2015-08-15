<?php
/**
 * Created by PhpStorm.
 * User: Family
 * Date: 08.04.2015
 * Time: 15:49
 */



class FileController extends Controller
{
    /** Upload and Save file */
    public function actionUpload()
    {
        $directory = realpath(Yii::app()->basePath.'/../file/upload/').'/';
        $file = md5(date('YmdHis')).'.'.pathinfo(@$_FILES['file']['name'], PATHINFO_EXTENSION);

        if (move_uploaded_file(@$_FILES['file']['tmp_name'], $directory.$file)) {
            $array = array(
                'filelink' => '/file/upload/'.$file
            );
        }

        echo CJSON::encode($array);
        exit ;
    }
}