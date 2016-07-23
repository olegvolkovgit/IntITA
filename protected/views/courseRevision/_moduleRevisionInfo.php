<label>Властивості ревізії модуля: </label>
<table class="table">
    <tr>
        <td>Cтатус:</td>
        <td>
            <div>{{moduleData.module.status}}</div>
            <div class="editButtons">
                <img ng-if=moduleData ng-click=previewModuleRevision('<?=Yii::app()->createUrl("moduleRevision/previewModuleRevision", array("idRevision" => $moduleRevision->id_module_revision)); ?>')
                     src="<?php echo StaticFilesHelper::createPath('image', 'editor', 'preview.png'); ?>"
                     title="Попередній перегляд"/>
                <img ng-if=moduleData.module.canSend ng-click=sendModuleRevision('<?php echo $moduleRevision->id_module_revision; ?>',true)
                     src="<?php echo StaticFilesHelper::createPath('image', 'editor', 'send_approve.png'); ?>"
                     title="Відправити на затвердження"/>
                <img ng-if=moduleData.module.canCancelEdit ng-click=cancelModuleEditByEditor('<?php echo $moduleRevision->id_module_revision; ?>',true)
                     src="<?php echo StaticFilesHelper::createPath('image', 'editor', 'cancelled_author.png'); ?>"
                     title="Відміна автором"/>
            </div>
        </td>
        <td>Номер ревізії:</td>
        <td><?=$moduleRevision->id_module_revision ?></td>
    </tr>
    <tr>
        <td>Назва (укр):</td>
        <td>
            <?php
            $this->widget('editable.EditableField', array(
                'type' => 'text',
                'model' => $moduleRevision->properties,
                'attribute' => 'title_ua',
                'url' => $this->createUrl('moduleRevision/XEditableEditProperties'),
                'title' => Yii::t('lecture', '0567'),
                'placement' => 'right',
            ));
            ?>
        </td>
        <td>Для кого:</td>
        <td>
            <?php
            $this->widget('editable.EditableField', array(
                'type' => 'text',
                'model' => $moduleRevision->properties,
                'attribute' => 'for_whom',
                'url' => $this->createUrl('moduleRevision/XEditableEditProperties'),
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
                'model' => $moduleRevision->properties,
                'attribute' => 'title_ru',
                'url' => $this->createUrl('moduleRevision/XEditableEditProperties'),
                'title' => Yii::t('lecture', '0567'),
                'placement' => 'right',
            ));
            ?>
        </td>

        <td>Що ти отримаєш:</td>
        <td>
            <?php
            $this->widget('editable.EditableField', array(
                'type' => 'text',
                'model' => $moduleRevision->properties,
                'attribute' => 'what_you_get',
                'url' => $this->createUrl('moduleRevision/XEditableEditProperties'),
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
                'model' => $moduleRevision->properties,
                'attribute' => 'title_en',
                'url' => $this->createUrl('moduleRevision/XEditableEditProperties'),
                'title' => Yii::t('lecture', '0567'),
                'placement' => 'right',
            ));
            ?>
        </td>

        <td>Що ти вивчиш:</td>
        <td>
            <?php
            $this->widget('editable.EditableField', array(
                'type' => 'text',
                'model' => $moduleRevision->properties,
                'attribute' => 'what_you_learn',
                'url' => $this->createUrl('moduleRevision/XEditableEditProperties'),
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
                'model' => $moduleRevision->properties,
                'attribute' => 'alias',
                'url' => $this->createUrl('moduleRevision/XEditableEditProperties'),
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
                'model' => $moduleRevision->properties,
                'attribute' => 'level',
                'url' => $this->createUrl('moduleRevision/XEditableEditProperties'),
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
        <td>Годин в день:</td>
        <td>
            <?php
            $this->widget('editable.EditableField', array(
                'type' => 'text',
                'model' => $moduleRevision->properties,
                'attribute' => 'hours_in_day',
                'url' => $this->createUrl('moduleRevision/XEditableEditProperties'),
                'title' => 'Годин в дні:',
                'placement' => 'right',
            ));
            ?>
        </td>
        <td>Доступність модуля:</td>
        <td><?=$moduleRevision->properties->cancelled?'Скасований':'Доступний' ?></td>
    </tr>
    <tr>
        <td>Днів в тиждень:</td>
        <td>
            <?php
            $this->widget('editable.EditableField', array(
                'type' => 'text',
                'model' => $moduleRevision->properties,
                'attribute' => 'days_in_week',
                'url' => $this->createUrl('moduleRevision/XEditableEditProperties'),
                'title' => 'Днів в тижні:',
                'placement' => 'right',
            ));
            ?>
        </td>

        <td>Готовність модуля:</td>
        <td><?=$moduleRevision->properties->status?'Готовий':'В розробці' ?></td>
    </tr>
    <tr>
        <td>Автор:</td>
        <td><?=StudentReg::getUserNamePayment($moduleRevision->properties->id_user_created).' (id='.$moduleRevision->properties->id_user_created.')'?></td>
        <td>Логотип:</td>
        <td>
            <img class="moduleImg"
                 src="<?php echo StaticFilesHelper::createPath('image', 'module', $moduleRevision->properties->module_img); ?>"/>
            <div style="display: inline-block" class="imageUpdateForm">
                <?php $form = $this->beginWidget('CActiveForm', array(
                    'id' => 'moduleImage-form',
                    'action' => Yii::app()->createUrl('moduleRevision/updateModuleRevisionImage', array('id' => $moduleRevision->properties->id)),
                    'htmlOptions' => array(
                        'class' => 'formatted-form',
                        'enctype' => 'multipart/form-data',
                    ),
                    'enableAjaxValidation' => false,
                )); ?>
                <div class="fileform">
                    <div class="hideInput">
                        <?php echo $form->fileField($moduleRevision->properties, 'module_img', array('tabindex' => '-1', 'id' => 'logoModule', 'onChange' => 'js:getImgName(this.value);CheckFile(this)')); ?>
                    </div>
                    <div>
                        <?php echo $form->error($moduleRevision->properties, 'module_img'); ?>
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
