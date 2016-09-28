<?php
/**
 * Created by PhpStorm.
 * User: Ivanna
 * Date: 12.05.2015
 * Time: 15:49
 */
?>
<div class="bgBlue" id="xex">
    <table>
        <tr>
            <td valign="top" style="width: 80px">
                <img src="<?php echo StaticFilesHelper::createPath('image', 'courses', 'course99.png');?>">
            </td>
            <td>
                <div id='coursesHeader'>
                    <?php echo Yii::t('courses', '0067'); ?>
                </div>

            </td>
            <td valign="top" style="float: right;width: 30px">
                <div id="xex" onclick='xexx()' style="cursor: pointer;">
                    <img src="<?php echo StaticFilesHelper::createPath('image', 'common', 'close_button.png');?>">
                </div>
            </td>
        </tr>
    </table>
    <div class='courseBox2'>
        <span id='courseText2'><?php echo Yii::t('courses', '0148'); ?></span>
        <?php $tmp = Yii::t('courses', '0229');?>
        <div class="razv"
             onclick='wrt("<?php echo $tmp;?>")'>
            <br>
            <u><?php echo Yii::t('courses', '0146'); ?></u>
        </div>
        <br>
        <div id="sver" onclick='wrt("");'></div>
        <br>
    </div>
</div>