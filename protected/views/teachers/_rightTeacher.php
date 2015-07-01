<?php
/**
 * Created by PhpStorm.
 * User: Ivanna
 * Date: 12.05.2015
 * Time: 17:04
 */
//$i=4;
//$i++;
//var_dump($i);
//var_dump($i % 2 == 0);
//var_dump($post[$i-1]);die;
?>
<div class="rightTeacher">
    <?php $this->renderPartial('_ifYouTeachers', array('post' => $post,'teacherletter'=>$teacherletter)); ?>

    <?php
    $j=0;
    foreach ($post as $teacherValue) {
        $j++;
        if ($j % 2 == 0) {
            ?>
            <div class="teacherBlock">
                <table>
                    <tr>
                        <td class="profileTeacher" >
                            <img class='teacherAvatar' src="<?php echo StaticFilesHelper::createPath('image', 'teachers', $teacherValue->foto_url);?>"/>
                            <a href="<?php echo Yii::app()->createUrl('profile/index', array('idTeacher' => $teacherValue->teacher_id));?>"><?php echo Yii::t('teachers', '0059'); ?>&#187;</a>
                        </td>
                        <td>
                            <h2><?php echo $teacherValue->last_name ?></h2>
                            <h2><?php echo $teacherValue->first_name ?> <?php echo $teacherValue->middle_name ?></h2>
                            <?php echo $teacherValue->profile_text_short ?>
                            <?php $modules = TeacherHelper::getModulesByTeacher($teacherValue->teacher_id);
                            if (!empty($modules)){?>
                                <p>
                                    <?php echo Yii::t('teachers', '0061'); ?>
                                </p>
                                <div class="TeacherProfilecourse">

                                    <div class="teacherCourses">
                                        <ul>
                                            <?php
                                            $count = count($modules);
                                            for ($i = 0; $i < $count; $i++) {
                                                ?>
                                                <li>
                                                    <a href="<?php echo Yii::app()->createUrl('module/index', array('idModule' =>$modules[$i]["idModule"], 'idCourse'=>$modules[$i]["idCourse"]));?>"><?php echo $modules[$i]["title"]; ?></a>
                                                </li>
                                            <?php
                                            }
                                            ?>
                                        </ul>
                                    </div>
                                </div>
                            <?php }?>
                        </td>
                    </tr>
                </table>
                <div class="aboutMore">
                    <img src="<?php echo StaticFilesHelper::createPath('image', 'teachers', 'readMore.png');?>"/> <a href="<?php echo Yii::app()->createUrl('profile/index', array('idTeacher' => $teacherValue->teacher_id));?>"><?php echo Yii::t('teachers', '0062'); ?> &#187;</a><br>
                    <?php
                    for ($k=0; $k<$teacherValue->rating; $k++) {?>
                        <img src="<?php echo StaticFilesHelper::createPath('image', 'common', 'starFull.png');?>"/><?php
                    }
                    for ($k=$teacherValue->rating; $k<10; $k++) {?>
                        <img src="<?php echo StaticFilesHelper::createPath('image', 'common', 'starEmpty.png');?>"/><?php
                    }
                    ?>
                    <a href="<?php echo Yii::app()->createUrl('profile/index', array('idTeacher' => $teacherValue->teacher_id));?>"><?php echo Yii::t('teachers', '0063'); ?> &#187;</a>
                </div>
            </div>
        <?php
        }
    }
    ?>
</div>