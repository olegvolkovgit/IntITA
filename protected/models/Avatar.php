<?php
/**
 * Created by PhpStorm.
 * User: Quicks
 * Date: 28.10.2015
 * Time: 17:36
 */

class Avatar {

    private $oldLogo;
    private $logo;
    private $path;


    public static function saveCourseLogo($model,$imgName)
    {
        $name = $imgName . '_img';
        $folder = ($imgName == 'course')?'course':'teachers';
        //var_dump($folder);die;
        if($model->start=='') $model->start=null;
        if (($model->scenario=="update") && (empty($model->logo['tmp_name'][$name])))
        {
            $model->course_img=$model->oldLogo;
        } else if(($model->scenario=="update") && (!empty($model->logo['tmp_name'][$name]))){
            $src=Yii::getPathOfAlias('webroot')."/images/.$folder./".$model->oldLogo;
            if (is_file($src))
                unlink($src);
        }
        if (($model->scenario=="insert" || $model->scenario=="update") && !empty($model->logo['tmp_name']['course_img']))
        {
            if(!copy($model->logo['tmp_name'][$name],Yii::getPathOfAlias('webroot')."/images/".$folder."/".$model->logo['name'][$name]))
                throw new CHttpException(500);
        }
        return true;
    }


    public static function saveStudentAvatar($model)
    {
        $fileName = FileUploadHelper::getFileName($model->avatar);
        $model->avatar->saveAs(Yii::getpathOfAlias('webroot') . "/images/avatars/" . $fileName);
        $model->updateByPk(Yii::app()->user->id, array('avatar' => $fileName));
    }

    public static function deleteStudentAvatar()
    {
        $id = Yii::app()->user->id;
        $model = StudentReg::model()->findByPk(Yii::app()->user->id);
        if ($model->avatar !== 'noname.png') {
            unlink(Yii::getpathOfAlias('webroot') . '/images/avatars/' . $model->avatar);
            $model->updateByPk($id, array('avatar' => 'noname.png'));
        }
    }

    public static function updateModuleAvatar($imageName,$tmpName,$id,$oldLogo)
    {
        $ext = substr(strrchr($imageName, '.'), 1);
        $imageName = uniqid() . '.' . $ext;
        if (copy($tmpName, Yii::getpathOfAlias('webroot') . "/images/module/" . $imageName)) {
            $src = Yii::getPathOfAlias('webroot') . "/images/module/" . $oldLogo;
            if (is_file($src) && $oldLogo!='courseimg1.png')
                unlink($src);
        }

        Module::model()->updateByPk($id, array('module_img' => $imageName));
        ImageHelper::uploadAndResizeImg(
            Yii::getPathOfAlias('webroot')."/images/module/".$imageName,
            Yii::getPathOfAlias('webroot') . "/images/module/share/shareModuleImg_".$id.'.'.$ext,
            210
        );

        return true;

    }

}