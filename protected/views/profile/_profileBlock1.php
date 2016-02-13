<?php
/* @var $model Teacher*/
if ($editMode){
    ?>
    <script src="<?php echo StaticFilesHelper::fullPathTo('js', 'fileValidation.js');?>"></script>
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
                <br>
                <div style="margin-left:20px;">
                <a id="btnChat" href="<?=Yii::app()->createUrl('chat/index');?>"  data-toggle="tooltip" data-placement="left" title="Розпочати бесіду"><span class="glyphicon glyphicon-comment"></span></a>
                <a id="btnChat" href="<?=Yii::app()->createUrl('chat/index');?>"  data-toggle="tooltip" data-placement="top" title="Приватне повідомлення"><span class="glyphicon glyphicon-envelope"></span></a>
                </div>
                    <?php if ($editMode) {?>
                <div class="avatarUpdateForm">
                    <?php if($model->foto_url!=='noname2.png') {
                        ?>
                        <div>
                            <a href="<?php echo Yii::app()->createUrl('profile/deleteAvatar');?>">
                                <?php echo Yii::t('regexp', '0561');?>
                            </a>
                        </div>
                        <?php
                    }
                    ?>
                    <?php $form=$this->beginWidget('CActiveForm', array(
                        'id'=>'teacherAvatar-form',
                        'action'=> Yii::app()->createUrl('teachers/updateTeacherAvatar', array('id'=>$model->teacher_id)),
                        'htmlOptions'=>array(
                            'class'=>'formatted-form',
                            'enctype'=>'multipart/form-data',
                        ),
                        'enableAjaxValidation'=>false,
                    )); ?>
                    <div class="fileform">
                        <div class="hideInput">
                            <?php echo $form->fileField($model, 'foto_url',array('tabindex' => '-1','id'=>'teacherAvatar', 'onChange'=>'js:getImgName(this.value);CheckFile(this)')); ?>
                            <?php echo $form->error($model,'foto_url'); ?>
                        </div>
                        <div>
                            <label id="avatar" for="teacherAvatar" >
                                <?php echo 'Вибрати';?>
                            </label>
                        </div>
                    </div>
                    <div id="errorMessage"></div>
                    <div id="avatarInfo"><?php echo Yii::t('regexp', '0159');?></div>
                    <div class="row buttons">
                        <?php echo CHtml::submitButton($model->isNewRecord ? Yii::t('coursemanage', '0398') : Yii::t('coursemanage', '0399'), array('id'=>'imgButton')); ?>
                    </div>
                    <?php $this->endWidget(); ?>
                </div><!-- form -->
                <?php }?>
            </td>
            <td>

            </td>
            <td>
                <div class="TeacherProfilename">
                    <?php echo $model->firstName()." ".$model->lastName();?>
                </div>
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
                <?php $this->renderPartial('_courses', array('model' => $model));?>
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
            'closefullscreen' => array(
                'js' => array('closefullscreen.js',),
            ),
        ),
    ));
}
?>