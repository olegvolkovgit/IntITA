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
                <div class="TeacherProfilename"> <?php echo $model->last_name;?></div>
                <div class="TeacherProfilename"> <?php echo $model->first_name.' '.$model->middle_name; ?> </div>

                <div class="TeacherProfiletitles">
                    <?php echo Yii::t('teacher', '0064') ?>
                </div>

                <div class="TeacherProfilesectionText">
                    <?php
                    foreach ($sections as $val) {
                        echo $val; ?><p></p><?php
                    }
                    ?>
                </div>

                <div class="TeacherProfiletitles">
                    <?php echo Yii::t('teacher', '0065') ?>
                </div>

                <?php
                if ($editMode) {
                    $currentDiv = 'txtMsgFirst';
                    // $this->renderPartial('_editorToolbar', array('div' => $currentDiv, 'order' => 3));
                    ?>
                    <div class="imperaviSimple" id="3">
                    <!--start toolbar for wysiwyg-->
                    <div class="btns-imperaviSimple" style="width: 100%; height: 30px; border: solid 0px black; margin-bottom: 10px;">
                        <div class="wrapper-imperaviSemple" style="border: solid 0px black; display: inline-block; float: left;"></div>
                        <div class="btn-edit-ImperaviSimple" id="editIcon1"
                             style="border: solid 0px black; display: inline-block; float: right; text-align: center; padding-top: 3px; cursor: pointer;"
                             onclick="pressEditRedactor('.<?php echo $currentDiv;?>', 'editIcon1', 'cancelIcon1', 'saveIcon1');"
                        <?$field = '.redactor'?>
                        <img src="<?php echo StaticFilesHelper::createPath('image', 'icons', 'edt_30px.png');?>" class="icons" >
                    </div>
                    <div class="btn-cancel-ImperaviSimple" id="cancelIcon1"
                         style="width: 5%; height: 100%; border: solid 0px black; float: right; text-align: center;  padding-top: 3px; cursor: pointer; display: none;"
                         onclick="pressCancelRedactor('.<?php echo $currentDiv;?>', 'editIcon1', 'cancelIcon1', 'saveIcon1')">
                        <img src="<?php echo StaticFilesHelper::createPath('image', 'icons', 'cls_30px.png');?>" class="icons" >
                    </div>
                    <div class="btn-save-ImperaviSimple" id="saveIcon1"
                         style="width:5%; height: 100%; border: solid 0px black; float: right; text-align: center; padding-right: 10px; padding-top: 3px; cursor: pointer; display: none;"
                         onclick="pressSaveRedactor('.<?php echo $currentDiv;?>', 'txtMsgFirst', 'editIcon1', 'cancelIcon1', 'saveIcon1');">
                        <img src="<?php echo StaticFilesHelper::createPath('image', 'icons', 'sv_30px.png');?>" class="icons" >
                    </div>
                    </div><?php
                }
                ?>


                <div class="txtMsgFirst">
                    <?php echo $model->profile_text_first; ?>
                </div>

                <?php echo Yii::t('teachers', '0061'); ?>

                <?php
                $this->renderPartial('_courses', array('courses' => $coursesID, 'titles' => $titles));
                ?>

                <?php
                if ($editMode) {
                    ?>
                    <div class="imperaviSimple" id="5">
                    <!--start toolbar for wysiwyg-->
                    <div class="btns-imperaviSimple" style="width: 100%; height: 30px; border: solid 0px black; margin-bottom: 10px;">
                        <div class="wrapper-imperaviSemple" style="border: solid 0px black; display: inline-block; float: left;"></div>
                        <div class="btn-edit-ImperaviSimple" id="editIcon2"
                             style="border: solid 0px black; display: inline-block; float: right; text-align: center; padding-top: 3px; cursor: pointer;"
                             onclick="pressEditRedactor('.txtMsgSecond', 'editIcon2', 'cancelIcon2', 'saveIcon2');" <?$field = '.redactor'?>
                        <img src="<?php echo StaticFilesHelper::createPath('image', 'icons', 'edt_30px.png');?>" class="icons" >
                    </div>
                    <div class="btn-cancel-ImperaviSimple"  id="cancelIcon2"
                         style="width: 5%; height: 100%; border: solid 0px black; float: right; text-align: center;  padding-top: 3px; cursor: pointer; display: none;"
                         onclick="pressCancelRedactor('.txtMsgSecond', 'editIcon2', 'cancelIcon2', 'saveIcon2')">
                        <img src="<?php echo StaticFilesHelper::createPath('image', 'icons', 'cls_30px.png');?>" class="icons">
                    </div>
                    <div class="btn-save-ImperaviSimple" id="saveIcon2"
                         style="width:5%; height: 100%; border: solid 0px black; float: right; text-align: center; padding-right: 10px; padding-top: 3px; cursor: pointer; display: none;"
                         onclick="pressSaveRedactor('.txtMsgSecond', 'txtMsgSecond', 'editIcon2', 'cancelIcon2', 'saveIcon2');">
                        <img src="<?php echo StaticFilesHelper::createPath('image', 'icons', 'sv_30px.png');?>" class="icons" >
                    </div>
                    </div><?php
                }
                ?>

                <div class="txtMsgSecond">
                    <?php echo $model->profile_text_last;?>
                </div>
                <br>
                <?php
                if ($editMode) {
                    ?>
                    <form id="updateProfile" action="<?php echo Yii::app()->createUrl('profile/save');?>" method="post">
                        <input name="id" value="<?php echo $model->teacher_id; ?>" hidden="hidden"/>
                        <input name="firstText" value="" hidden="hidden" id="firstText"/>
                        <input name="secondText" value="" hidden="hidden" id="secondText"/>
                        <textarea id="content" name="content"  hidden="hidden"></textarea>
                        <p>
                            <button onclick="javascript:getContent();" id="updateButton">
                                UPDATE
                            </button>
                        </p>
                    </form>
                <?php
                }
                ?>
            </td>
        </tr>
    </table>
</div>