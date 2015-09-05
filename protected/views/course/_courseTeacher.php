<?php
$criteria = new CDbCriteria();
$criteria->addInCondition('teacher_id', $teachers);
$teachers = Teacher::model()->findAll($criteria);

?>
    <!-- course style -->
    <link type="text/css" rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/css/course.css" />
    <!-- course style -->
<?php
for($i = 0; $i < count($teachers); $i++){
    ?>
    <div id="teacher<?php echo $i;?>">
        <div class="courseTeacher">
            <div class="courseTeacherImg">
                <a href="<?php echo Yii::app()->createUrl('profile/index', array('idTeacher' => $teachers[$i]->teacher_id));?>">
                    <img src="<?php echo StaticFilesHelper::createPath('image', 'teachers', $teachers[$i]->foto_url);?>" />
                </a>
            </div>
            <div class="courseTeacherInfo">
                <h3><a href="<?php echo Yii::app()->createUrl('profile/index', array('idTeacher' => $teachers[$i]->teacher_id));?>"><?php echo $teachers[$i]->last_name . " " . $teachers[$i]->first_name; ?></a></h3>
                <table class="courseTeacherDetail">
                    <?php

                    $teacherModules = ModuleHelper::getTeacherModules($teachers[$i]->teacher_id, $modules);
                    //var_dump($teachers[0]);die();
                    for($k = 0; $k < count($teacherModules); $k++){
                        ?>
                        <tr>
                            <td>
                                <a href="<?php echo Yii::app()->createUrl('module/index', array('idModule' => $teacherModules[$k]));?>"><span class="colorGrey"><?php echo Yii::t('course', '0208');  echo ' '.ModuleHelper::getModuleOrder($teacherModules[$k]);?>: </span><span class="colorP"><?php echo ModuleHelper::getModuleName($teacherModules[$k]); ?></a></span>
                            </td>
                        </tr>
                    <?php
                    }
                    ?>
                </table>
            </div>
        </div>
    </div>
<?php
}
?>