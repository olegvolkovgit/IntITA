<?php
$criteria1 = new CDbCriteria();
$criteria1->addInCondition('owners', [3]);
$modules = Module::model()->findAll($criteria1);
?>
    <!-- course style -->
    <link type="text/css" rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/css/course.css" />
    <!-- course style -->
<div class="courseTeacher">
    <div class="courseTeacherImg">
        <a href="<?php echo Yii::app()->createUrl('profile/index', array('idTeacher' => $data['teacher_id']));?>">
            <img src="<?php echo StaticFilesHelper::createPath('image', 'teachers', $data['foto_url']);?>" />
         </a>
    </div>
    <div class="courseTeacherInfo">
        <h3><a href="<?php echo Yii::app()->createUrl('profile/index', array('idTeacher' => $data['teacher_id']));?>"><?php echo $data['last_name'] . " " . $data['first_name']; ?></a></h3>
        <table class="courseTeacherDetail">
            <?php
            for($k = 0; $k < count($modules); $k++){
                ?>
                <tr>
                    <td>
                        <span class="colorP"><?php echo Yii::t('course', '0208');  echo $k+1;?> :</span><span class="colorGrey"><a href="<?php echo Yii::app()->createUrl('module');?>"><?php echo $modules[$k]->module_name; ?></a></span>
                    </td>
                </tr>
            <?php
            }
            ?>
        </table>
    </div>
</div>

