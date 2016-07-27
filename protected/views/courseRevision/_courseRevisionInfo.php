<label>Властивості ревізії курса: </label>
<table class="table">
    <tr>
        <td>Cтатус:</td>
        <td>
            <div>{{courseData.course.status}}</div>
            <div class="editButtons">
                <img ng-if=courseData ng-click=previewCourseRevision('<?=Yii::app()->createUrl("courseRevision/previewCourseRevision", array("idRevision" => $courseRevision->id_course_revision)); ?>')
                     src="<?php echo StaticFilesHelper::createPath('image', 'editor', 'preview.png'); ?>"
                     title="Попередній перегляд"/>
                <img ng-if=courseData.course.canSend ng-click=sendCourseRevision('<?php echo $courseRevision->id_course_revision; ?>',true)
                     src="<?php echo StaticFilesHelper::createPath('image', 'editor', 'send_approve.png'); ?>"
                     title="Відправити на затвердження"/>
                <img ng-if=courseData.course.canCancelEdit ng-click=cancelCourseEditByEditor('<?php echo $courseRevision->id_course_revision; ?>',true)
                     src="<?php echo StaticFilesHelper::createPath('image', 'editor', 'cancelled_author.png'); ?>"
                     title="Відміна автором"/>
            </div>
        </td>
        <td>Номер ревізії:</td>
        <td><?=$courseRevision->id_course_revision ?></td>
    </tr>
    <tr>
        <td>Назва (укр):</td>
        <td>
            <?php

            $this->widget('editable.EditableField', array(
                'type' => 'text',
                'model' => $courseRevision->properties,
                'attribute' => 'title_ua',
                'url' => $this->createUrl('courseRevision/XEditableEditProperties'),
                'title' => Yii::t('lecture', '0567'),
                'placement' => 'right',
            ));
            ?>
        </td>
        <td>Для кого(UA):</td>
        <td>
            <?php
            $this->widget('editable.EditableField', array(
                'type' => 'text',
                'model' => $courseRevision->properties,
                'attribute' => 'for_whom_ua',
                'url' => $this->createUrl('courseRevision/XEditableEditProperties'),
                'title' => 'Для кого:',
                'placement' => 'right',
            ));
            ?>
        </td>
    </tr>
    <tr>
        <td>Назва (рос):</td>
        <td>
            <?php
            $this->widget('editable.EditableField', array(
                'type' => 'text',
                'model' => $courseRevision->properties,
                'attribute' => 'title_ru',
                'url' => $this->createUrl('courseRevision/XEditableEditProperties'),
                'title' => Yii::t('lecture', '0567'),
                'placement' => 'right',
            ));
            ?>
        </td>

        <td>Що ти отримаєш(UA):</td>
        <td>
            <?php
            $this->widget('editable.EditableField', array(
                'type' => 'text',
                'model' => $courseRevision->properties,
                'attribute' => 'what_you_get_ua',
                'url' => $this->createUrl('courseRevision/XEditableEditProperties'),
                'title' => 'Що ти отримаєш:',
                'placement' => 'right',
            ));
            ?>
        </td>
    </tr>
    <tr>
        <td>Назва (англ):</td>
        <td>
            <?php
            $this->widget('editable.EditableField', array(
                'type' => 'text',
                'model' => $courseRevision->properties,
                'attribute' => 'title_en',
                'url' => $this->createUrl('courseRevision/XEditableEditProperties'),
                'title' => Yii::t('lecture', '0567'),
                'placement' => 'right',
            ));
            ?>
        </td>

        <td>Що ти вивчиш(UA):</td>
        <td>
            <?php
            $this->widget('editable.EditableField', array(
                'type' => 'text',
                'model' => $courseRevision->properties,
                'attribute' => 'what_you_learn_ua',
                'url' => $this->createUrl('courseRevision/XEditableEditProperties'),
                'title' => 'Що ти вивчиш:',
                'placement' => 'right',
            ));
            ?>
        </td>
    </tr>
    <tr>
        <td>Для кого(RU):</td>
        <td>
            <?php
            $this->widget('editable.EditableField', array(
                'type' => 'text',
                'model' => $courseRevision->properties,
                'attribute' => 'for_whom_ru',
                'url' => $this->createUrl('courseRevision/XEditableEditProperties'),
                'title' => 'Для кого:',
                'placement' => 'right',
            ));
            ?>
        </td>

        <td>Для кого(EN):</td>
        <td>
            <?php
            $this->widget('editable.EditableField', array(
                'type' => 'text',
                'model' => $courseRevision->properties,
                'attribute' => 'for_whom_en',
                'url' => $this->createUrl('courseRevision/XEditableEditProperties'),
                'title' => 'Для кого:',
                'placement' => 'right',
            ));
            ?>
        </td>
    </tr>
    <tr>
        <td>Що ти отримаєш(RU):</td>
        <td>
            <?php
            $this->widget('editable.EditableField', array(
                'type' => 'text',
                'model' => $courseRevision->properties,
                'attribute' => 'what_you_get_ru',
                'url' => $this->createUrl('courseRevision/XEditableEditProperties'),
                'title' => 'Що ти отримаєш:',
                'placement' => 'right',
            ));
            ?>
        </td>

        <td>Що ти отримаєш(EN):</td>
        <td>
            <?php
            $this->widget('editable.EditableField', array(
                'type' => 'text',
                'model' => $courseRevision->properties,
                'attribute' => 'what_you_get_en',
                'url' => $this->createUrl('courseRevision/XEditableEditProperties'),
                'title' => 'Що ти отримаєш:',
                'placement' => 'right',
            ));
            ?>
        </td>
    </tr>
    <tr>
        <td>Що ти вивчиш(RU):</td>
        <td>
            <?php
            $this->widget('editable.EditableField', array(
                'type' => 'text',
                'model' => $courseRevision->properties,
                'attribute' => 'what_you_learn_ru',
                'url' => $this->createUrl('courseRevision/XEditableEditProperties'),
                'title' => 'Що ти вивчиш:',
                'placement' => 'right',
            ));
            ?>
        </td>

        <td>Що ти вивчиш(EN):</td>
        <td>
            <?php
            $this->widget('editable.EditableField', array(
                'type' => 'text',
                'model' => $courseRevision->properties,
                'attribute' => 'what_you_learn_en',
                'url' => $this->createUrl('courseRevision/XEditableEditProperties'),
                'title' => 'Що ти вивчиш:',
                'placement' => 'right',
            ));
            ?>
        </td>
    </tr>
    <tr>
        <td>Псевдонім:</td>
        <td>
            <?php
            $this->widget('editable.EditableField', array(
                'type' => 'text',
                'model' => $courseRevision->properties,
                'attribute' => 'alias',
                'url' => $this->createUrl('courseRevision/XEditableEditProperties'),
                'title' => 'Псевдонім',
                'placement' => 'right',
            ));
            ?>
        </td>
        <td>Рівень:</td>
        <td>
            <?php
            $sources = Level::allTitlesByLang('ua');
            $this->widget('editable.EditableField', array(
                'type' => 'select',
                'model' => $courseRevision->properties,
                'attribute' => 'level',
                'url' => $this->createUrl('courseRevision/XEditableEditProperties'),
                'source' => Editable::source(array(
                        '1' => $sources[1],
                        '2' => $sources[2],
                        '3' => $sources[3],
                        '4' => $sources[4],
                        '5' => $sources[5]
                    )
                ),
                'title' => 'Рівень:',
                'placement' => 'right',
            ));
            ?>
        </td>
    </tr>
    <tr>
        <td>Доступність модуля:</td>
        <td><?=$courseRevision->properties->cancelled?'Скасований':'Доступний' ?></td>
        
        <td>Готовність модуля:</td>
        <td><?=$courseRevision->properties->status?'Готовий':'В розробці' ?></td>
    </tr>
    <tr>
        <td>Автор:</td>
        <td><?=StudentReg::getUserNamePayment($courseRevision->properties->id_user_created).' (id='.$courseRevision->properties->id_user_created.')'?></td>
        <td>Логотип:</td>
        <td>
            <img class="moduleImg"
                 src="<?php echo StaticFilesHelper::createPath('image', 'course', $courseRevision->properties->course_img); ?>"/>
            <div style="display: inline-block" class="imageUpdateForm">
                <?php $form = $this->beginWidget('CActiveForm', array(
                    'id' => 'courseImage-form',
                    'action' => Yii::app()->createUrl('courseRevision/updateCourseRevisionImage', array('id' => $courseRevision->properties->id)),
                    'htmlOptions' => array(
                        'class' => 'formatted-form',
                        'enctype' => 'multipart/form-data',
                    ),
                    'enableAjaxValidation' => false,
                )); ?>
                <div class="fileform">
                    <div class="hideInput">
                        <?php echo $form->fileField($courseRevision->properties, 'course_img', array('tabindex' => '-1', 'id' => 'logoModule', 'onChange' => 'js:getImgName(this.value);CheckFile(this)')); ?>
                    </div>
                    <div>
                        <?php echo $form->error($courseRevision->properties, 'course_img'); ?>
                        <label id="logo" for="logoModule" >
                            <?php echo 'Вибрати'; ?>
                        </label>
                    </div>
                </div>
                <div id="errorMessage"></div>
                <div id="avatarInfo"><?php echo 'Не вибрано'; ?></div>
                <div class="row buttons">
                    <?php echo CHtml::submitButton(Yii::t('coursemanage', '0399'), array("class"=>"btn btn-primary", "id"=>"imgButton")); ?>
                </div>
                <?php $this->endWidget(); ?>
            </div>
        </td>
    </tr>
</table>
