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

        if($model->start=='') $model->start=null;

        if (($model->scenario=="update") && (empty($model->logo['tmp_name'][$name])))
        {
            $model->course_img=$model->oldLogo;
        } else if(($model->scenario=="update") && (!empty($model->logo['tmp_name'][$name]))){
            $src=Yii::getPathOfAlias('webroot')."/images/".$folder."/".$model->oldLogo;
            if (is_file($src) && $model->oldLogo!='courseImage.png')
                unlink($src);
        }
        if (($model->scenario=="insert" || $model->scenario=="update") && !empty($model->logo['tmp_name']['course_img']))
        {
            if(!copy($model->logo['tmp_name'][$name],Yii::getPathOfAlias('webroot')."/images/".$folder."/".$model->logo['name'][$name]))
                return false;
        }
        return true;
    }


    public static function saveStudentAvatar($model)
    {
        $fileName = FileUploadHelper::getFileName($model->avatar);
        $model->avatar->saveAs(Yii::getpathOfAlias('webroot') . "/images/avatars/" . $fileName);
        if(isset(Yii::app()->user->id)){
            $model->updateByPk(Yii::app()->user->id, array('avatar' => $fileName));
        }else{
            $model->avatar=$fileName;
        }
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
            if (is_file($src) && $oldLogo!='module.png')
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

    public static function updateTeacherAvatar($filename,$tmpName,$id,$oldAvatar)
    {
        $ext = substr(strrchr($filename, '.'), 1);
        $filename = uniqid() . '.' . $ext;

        if (copy($tmpName, Yii::getpathOfAlias('webroot') . "/images/teachers/" . $filename)) {
            $src = Yii::getPathOfAlias('webroot') . "/images/teachers/" . $oldAvatar;
            if (is_file($src) && $oldAvatar!='noname2.png')
                unlink($src);
        }
        Teacher::model()->updateByPk($id, array('foto_url' => $filename));
        ImageHelper::uploadAndResizeImg(
            Yii::getPathOfAlias('webroot')."/images/teachers/".$filename,
            Yii::getPathOfAlias('webroot') . "/images/teachers/share/shareTeacherAvatar_".$id.'.'.$ext,
            210
        );
        return true;
    }


    public static function saveTeachersAvatar($model,$imgName)
    {
        $folder = ($imgName == 'course')?'course':'teachers';

        if (($model->scenario=="update") && (empty($model->avatar['tmp_name']['foto_url'])))
        {
            $model->foto_url=$model->oldAvatar;
        } else if(($model->scenario=="update") && (!empty($model->avatar['tmp_name']['foto_url']))){
            $src=Yii::getPathOfAlias('webroot')."/images/".$folder."/".$model->oldAvatar;
            if (is_file($src))
                unlink($src);
        }
        if (($model->scenario=="insert" || $model->scenario=="update") && !empty($model->avatar['tmp_name']['foto_url']))
        {
            $tmpFoto = $model->avatar['tmp_name']['foto_url'];
            $path = Yii::getPathOfAlias('webroot')."/images/".$folder."/".$model->foto_url;

            if(!copy($tmpFoto,$path))
                return false;
        }
        return true;
    }

    public static function saveMainSliderPicture($model,$tmpName,$filename, $oldSlide='')
    {
        if ($model->scenario=="update")
        {
            if(!empty($tmpName['pictureURL'])){
                $src=Yii::getPathOfAlias('webroot')."/images/mainpage/".$oldSlide;
                if (is_file($src))
                    unlink($src);

                if(!copy($tmpName['pictureURL'],Yii::getPathOfAlias('webroot')."/images/mainpage/".$filename));
                return false;
            }
            $model->pictureURL=$filename;
            return true;
        }
        if ($model->scenario == "insert")
        {
            $lastOrder = $model->getLastOrder() + 1;

            $model->order = $lastOrder;

            if(!empty($tmpName['pictureURL'])){
                if(!copy($tmpName['pictureURL'],Yii::getPathOfAlias('webroot')."/images/mainpage/".$filename));
                return false;
            }
            return true;
        }
    }

    public static function saveAbuotusSlider($model,$tmpName,$filename, $oldSlide='')
    {
        if ($model->scenario=="update")
        {
            if(!empty($tmpName['pictureUrl'])){
                $src=Yii::getPathOfAlias('webroot')."/images/aboutus/".$oldSlide;
                if (is_file($src))
                    unlink($src);

                if(!copy($tmpName['pictureUrl'],Yii::getPathOfAlias('webroot')."/images/aboutus/".$filename));
                    return false;
            }
            $model->pictureUrl=$filename;
            return true;
        }
        if ($model->scenario == "insert")
        {
            $lastOrder = $model->getLastAboutusOrder() + 1;

            $model->order = $lastOrder;

            if(!empty($tmpName['pictureUrl'])){
                if(!copy($tmpName['pictureUrl'],Yii::getPathOfAlias('webroot')."/images/aboutus/".$filename));
                return false;
            }
            return true;
        }
    }

}