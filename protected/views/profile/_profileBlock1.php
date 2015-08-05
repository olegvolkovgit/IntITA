<?php
/**
 * Created by PhpStorm.
 * User: Ivanna
 * Date: 12.05.2015
 * Time: 16:52
 */
if ($editMode){
    ?>
    <script type="text/javascript">
        idTeacher = <?php echo $model->teacher_id;?>;
        block = 't1';
    </script>
<?php }?>

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

                <div class="editableText" id="t1" onclick="function(){order = 't1'; block='t1';}">
                    <p>
                    <?php if($model->profile_text_first != '') {
                        echo $model->profile_text_first;
                    } else {
                        if ($editMode){
                            echo "Натисніть для редагування профілю.";
                        }
                    }?>
                    </p>
                </div>
                <?php
                $this->renderPartial('_courses', array('id' => $model->teacher_id));
                ?>

                <div  class="editableText" id="t2" onclick="function(){order = 't2'; block='t2';}">
                    <p>
                        <?php if($model->profile_text_last != '') {
                            echo $model->profile_text_last;
                        } else {
                            if ($editMode){
                                echo "Натисніть для редагування профілю.";
                            }
                        }?>
                    </p>
                </div>
                <br>
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
