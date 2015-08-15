<?php
for ($i = 0; $i < count($teachers); $i++) {
    ?>
    <div class="teacherBox">
        <table>
            <tr>
                <td class="teacherBoxLeft">
                    <div class="photobg">
                        <img class="mask" src="<?php echo Yii::app()->request->baseUrl; ?>/images/common/img.png">
                        <img class="teacherphoto" src="<?php echo StaticFilesHelper::createPath('image', 'teachers', $teachers[$i]->foto_url)?>">
                    </div>
                    <a href="<?php echo Yii::app()->createUrl('profile/index', array('idTeacher' => $teachers[$i]->teacher_id)); ?>"> <?php echo Yii::t('module', '0228'); ?>&#187;</a>
                </td>
                <td class="teacherBoxRight">
                <h2><?php echo Yii::t('module', '0227'); ?></h2>

                <div style="line-height: 1.2;">
                    <?php echo $teachers[$i]->last_name . " " . $teachers[$i]->first_name; ?>
                    <br>
                    <?php echo $teachers[$i]->email; ?>
                    <br>
                    <?php echo "Skype: ", $teachers[$i]->skype; ?>
                </div>
                </td>
            </tr>
        </table>
    </div>
<?php
}
?>