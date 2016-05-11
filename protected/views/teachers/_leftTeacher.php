<?php
/**
 * @var $teacherValue Teacher
 * @var $module Module
 */
?>
<div class="leftTeacher">
    <?php
    $j=0;
    foreach ($post as $teacherValue) {
        $j++;
        if ($j % 2 <> 0) {
            ?>
            <div class="teacherBlock">
                <table>
                    <tr>
                        <td class="profileTeacher" >
                            <div class="avatarsize">
                                <img class='teacherAvatar' src="<?php echo StaticFilesHelper::createPath('image', 'avatars', $teacherValue->avatar());?>"/>
                            </div>
                            <a href="<?php echo Yii::app()->createUrl('profile/index',
                                array('idTeacher' => $teacherValue->user_id));?>">
                                <?php echo Yii::t('teachers', '0059'); ?>&#187;
                            </a>
                            <br>
                            <a class="btnChat" href="<?php
                                if (!Yii::app()->user->isGuest){
                                    echo Config::getBaseUrl(); echo Config::getChatPath(); echo $teacherValue->user_id; echo '" target="_blank';
                                } else {
                                    echo '#" '.'onclick="openSignIn();';
                                }
                                ?>" data-toggle="tooltip" data-placement="left" title="<?=Yii::t('teacher', '0794');?>"><img src="<?php echo StaticFilesHelper::createPath('image', 'teachers', 'chat.png');?>"></a>
                            <a class="btnChat" href="<?php
                            if (!Yii::app()->user->isGuest) {
                                echo Yii::app()->createUrl('/_teacher/cabinet/index', array(
                                    'scenario' => 'message',
                                    'receiver' => $teacherValue->user_id
                                ));
                            } else {
                                echo '#" ' . 'onclick="openSignIn();';
                            }?>" data-toggle="tooltip" data-placement="top" title="<?= Yii::t('teacher', '0795'); ?>"><img
                                    src="<?php echo StaticFilesHelper::createPath('image', 'teachers', 'mail.png'); ?>"></a>
                        </td>
                        <td>
                            <h2><?php echo $teacherValue->lastName(); ?></h2>
                            <h2><?php echo $teacherValue->firstName(); ?>
                                <?php echo $teacherValue->middleName(); ?></h2>
                            <?php echo $teacherValue->profile_text_short ?>
                            <?php $modules = $teacherValue->modulesActive;
                            if (!empty($modules)){?>
                                <p>
                                    <?php echo Yii::t('teachers', '0061'); ?>
                                </p>
                                <div class="TeacherProfilecourse">

                                    <div class="teacherCourses">
                                        <ul>
                                            <?php
                                            foreach ($modules as $module) {
                                                if(!$module->cancelled) {
                                                    ?>
                                                    <li>
                                                        <a href="<?php echo Yii::app()->createUrl('module/index',
                                                            array('idModule' => $module->module_ID)); ?>">
                                                            <?php echo $module->getTitle() . ', ' . $module->language; ?>
                                                        </a>
                                                    </li>
                                                    <?php
                                                }
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
                    <img src="<?php echo StaticFilesHelper::createPath('image', 'teachers', 'readMore.png');?>"/>
                    <a href="<?php echo Yii::app()->createUrl('profile/index', array('idTeacher' => $teacherValue->user_id));?>">
                        <?php echo Yii::t('teachers', '0062'); ?> &#187;
                    </a>
                    <br>
                    <?php echo CommonHelper::getRating($teacherValue->rating); ?>
                    <a href="<?php echo Yii::app()->createUrl('profile/index', array('idTeacher' => $teacherValue->user_id));?>">
                        <?php echo Yii::t('teachers', '0063'); ?> &#187;
                    </a>
                </div>
            </div>
        <?php
        }
    }
    ?>
</div>