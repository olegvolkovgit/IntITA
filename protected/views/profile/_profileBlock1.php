<?php
/**
 * Created by PhpStorm.
 * User: Ivanna
 * Date: 12.05.2015
 * Time: 16:52
 */
?>
<div class="TeacherProfileblock1">
    <table>
        <tr>
            <td valign="top">
                <img src="<?php echo StaticFilesHelper::createPath('image', 'teachers', $model->foto_url);?>"/>
            </td>
            <td>
                <div class="TeacherProfilename"> <?php echo $model->first_name." ".$model->last_name;?></div>
                <div class="TeacherProfiletitles">
                    <?php echo Yii::t('teacher', '0065') ?>
                </div>

                <div class="editable"  onclick="function(){block = 1;}">
                    <?php echo $model->profile_text_first; ?>
                </div>
                <?php
                $this->renderPartial('_courses', array('id' => $model->teacher_id));
                ?>

                <div class="editable" onclick="function(){block = 2;}">
                    <?php echo $model->profile_text_last;?>
                </div>
                <br>
<!--                --><?php
//                if ($editMode) {
//                    ?>
<!--                    <form id="updateProfile" action="--><?php //echo Yii::app()->createUrl('profile/save');?><!--" method="post">-->
<!--                        <input name="id" value="--><?php //echo $model->teacher_id; ?><!--" hidden="hidden"/>-->
<!--                        <input name="firstText" value="" hidden="hidden" id="firstText"/>-->
<!--                        <input name="secondText" value="" hidden="hidden" id="secondText"/>-->
<!--                        <textarea id="content" name="content"  hidden="hidden"></textarea>-->
<!--                        <p>-->
<!--                            <button onclick="javascript:getContent();" id="updateButton">-->
<!--                                UPDATE-->
<!--                            </button>-->
<!--                        </p>-->
<!--                    </form>-->
<!--                --><?php
//                }
//                ?>
                <?php if(Yii::app()->user->hasFlash('success')):?>
                    <div class="info">
                        <?php echo Yii::app()->user->getFlash('success'); ?>
                    </div>
                <?php endif; ?>
            </td>
        </tr>
    </table>
</div>

<?php
// use editor WYSIWYG Imperavi
if ($editMode) {
    $this->widget('ImperaviRedactorWidget', array(
        'selector' => "#",
        'options' => array(
            'imageUpload' => $this->createUrl('files/upload'),
            'lang' => 'ua',
            'toolbar' => true,
            'iframe' => true,
            'css' => 'wym.css',
        ),
        'plugins' => array(
            'fullscreen' => array(
                'js' => array('fullscreen.js',),
            ),
            'video' => array(
                'js' => array('video.js',),
            ),
            'fontsize' => array(
                'js' => array('fontsize.js',),
            ),
            'fontfamily' => array(
                'js' => array('fontfamily.js',),
            ),
            'fontcolor' => array(
                'js' => array('fontcolor.js',),
            ),
            'save' => array(
                'js' => array('saveTeacherProfile.js',),
            ),
            'close' => array(
                'js' => array('close.js',),
            ),
        ),
    ));
}
?>