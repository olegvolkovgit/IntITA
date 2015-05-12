<?php
/**
 * Created by PhpStorm.
 * User: Ivanna
 * Date: 12.05.2015
 * Time: 17:02
 */
?>
<div class="leftTeacher">
    <?php
    $i=0;
    foreach ($post as $teacherValue) {
        $i++;
        if ($i % 2 <> 0) {
            ?>
            <div class="teacherBlock">
                <table>
                    <tr>
                        <td class="profileTeacher" >
                            <img class='teacherAvatar' src="<?php echo Yii::app()->request->baseUrl.$teacherValue->foto_url ?>"/>
                            <a href="<?php echo Yii::app()->createUrl('profile/index', array('idTeacher' => $teacherValue->teacher_id));?>"><?php echo Yii::t('teachers', '0059'); ?> &#187;</a>
                        </td>
                        <td>
                            <h2><?php echo $teacherValue->last_name ?></h2>
                            <h2><?php echo $teacherValue->first_name ?> <?php echo $teacherValue->middle_name ?></h2>
                            <?php echo $teacherValue->profile_text_short ?>
                            <p>
                                <?php echo Yii::t('teachers', '0061'); ?>
                            </p>
                            <div class="teacherCourses">
                                <ul>
                                    <?php
                                    for ($j = 0; $j < count($coursesID); $j++)
                                    {
                                        ?>
                                        <li><a href="<?php echo Yii::app()->createUrl('course/index', array('id' => $coursesID[$j]['course']));?>"><?php echo $titles[$j]['title']; ?></a></li>
                                    <?php
                                    }
                                    ?>
                                </ul>
                            </div>
                        </td>
                    </tr>
                </table>
                <div class="aboutMore">
                    <img src="<?php echo Yii::app()->request->baseUrl; ?>/css/images/readMore.png"/> <a href="<?php echo Yii::app()->createUrl('profile/index', array('idTeacher' => $teacherValue->teacher_id));?>"><?php echo Yii::t('teachers', '0062'); ?> &#187;</a></br>
                    <?php
                    for ($k=0; $k<10; $k++)
                    {
                        ?>
                        <img src="<?php echo Yii::app()->request->baseUrl; ?>/css/images/starFull.png"/>
                    <?php
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