<?php
/**
 * @var $teacher Teacher
 * @var $teachers array
 * @var $idModule
 */
foreach ($teachers as $teacher) {
    ?>
    <div class="teacherBox">
        <table>
            <tr>
                <td class="teacherBoxLeft">
                    <div class="photobg">
                        <img class="mask"
                             src="<?php echo StaticFilesHelper::createPath('image', 'common', 'img.png'); ?>">
                        <img class="teacherphoto"
                             src="<?php echo StaticFilesHelper::createPath('image', 'avatars', $teacher->avatar()) ?>">
                    </div>
                    <a href="<?php echo Yii::app()->createUrl('profile/index', array('idTeacher' => $teacher->user_id)); ?>">
                        <?php echo Yii::t('module', '0228'); ?>
                        &#187;</a>
                    <br>
                    <a class="btnChat" href="<?php
                    if (!Yii::app()->user->isGuest) {
                        echo Config::getBaseUrl();
                        echo Config::getChatPath();
                        echo $teacher->user_id;
                        echo '" target="_blank';
                    } else {
                        echo '" ' . 'onclick="openSignIn();';
                    }
                    ?>" data-toggle="tooltip" data-placement="left" title="<?= Yii::t('teacher', '0794'); ?>"><img
                            src="<?php echo StaticFilesHelper::createPath('image', 'teachers', 'chat.png'); ?>"></a>
                    <a class="btnChat" href="<?php
                    if (!Yii::app()->user->isGuest) {
                        echo Yii::app()->createUrl('/cabinet/#/newmessages/receiver/').$teacher->user_id;
                    } else {
                        echo '" ' . 'onclick="openSignIn();';
                    }?>" data-toggle="tooltip" data-placement="top" title="<?= Yii::t('teacher', '0795'); ?>"><img
                            src="<?php echo StaticFilesHelper::createPath('image', 'teachers', 'mail.png'); ?>"></a>
                </td>
                <td class="teacherBoxRight">
                    <h2><?php echo $teacher->getRolesTeacherInModule($idModule); ?></h2>

                    <div style="line-height: 1.2;word-break: break-word;">
                        <?php echo $teacher->getLastFirstName(); ?>
                        <br>
                        <?php echo $teacher->user->email; ?>
                        <br>
                        <?php
                        if ($teacher->skype() != '') {
                            echo "Skype: ", $teacher->skype();
                        } ?>
                    </div>
                </td>
            </tr>
        </table>
    </div>
    <?php
}
?>