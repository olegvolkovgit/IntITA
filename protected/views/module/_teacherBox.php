<?php
/**
 * @var $teacher Teacher
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
                             src="<?php echo StaticFilesHelper::createPath('image', 'teachers', $teacher->foto_url) ?>">
                    </div>
                    <a href="<?php echo Yii::app()->createUrl('profile/index', array('idTeacher' => $teacher->teacher_id)); ?>">
                        <?php echo Yii::t('module', '0228'); ?>
                        &#187;</a>
                </td>
                <td class="teacherBoxRight">
                    <h2><?php echo Yii::t('module', '0227'); ?></h2>

                    <div style="line-height: 1.2;">
                        <?php echo $teacher->getLastFirstName();?>
                        <br>
                        <?php echo $teacher->email; ?>
                        <br>
                        <?php
                        if ($teacher->skype != '') {
                            echo "Skype: ", $teacher->skype;
                        } ?>
                    </div>
                </td>
            </tr>
        </table>
    </div>
<?php
}
?>