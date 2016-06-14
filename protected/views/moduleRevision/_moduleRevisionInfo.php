<label>Властивості ревізії модуля: </label>
<table class="table">
    <tr>
        <td>Cтатус:</td>
        <td>
            <div>{{moduleData.module.status}}</div>
            <div class="editButtons">
                <img ng-if=lectureData ng-click=previewRevision('<?=Yii::app()->createUrl("revision/previewLectureRevision", array("idRevision" => $moduleRevision->id_module_revision)); ?>')
                     src="<?php echo StaticFilesHelper::createPath('image', 'editor', 'preview.png'); ?>"
                     title="Попередній перегляд"/>
                <img ng-if=lectureData.lecture.canSendForApproval ng-click=sendRevision('<?php echo $moduleRevision->id_module_revision; ?>')
                     src="<?php echo StaticFilesHelper::createPath('image', 'editor', 'send_approve.png'); ?>"
                     title="Відправити на затвердження"/>
                <img ng-if=lectureData.lecture.canCancelEdit ng-click=cancelEditByEditor('<?php echo $moduleRevision->id_module_revision; ?>')
                     src="<?php echo StaticFilesHelper::createPath('image', 'editor', 'cancelled_author.png'); ?>"
                     title="Відміна автором"/>
            </div>
        </td>
    </tr>
    <tr>
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
    </tr>
    <tr>
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
    </tr>
    <tr>
        <td>Днів в тижні:</td>
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
    </tr>
    <tr>
        <td>Доступність модуля:</td>
        <td>
            <?php
            $this->widget('editable.EditableField', array(
                'type' => 'select',
                'model' => $moduleRevision->properties,
                'attribute' => 'cancelled',
                'url' => $this->createUrl('moduleRevision/XEditableEditProperties'),
                'source' => Editable::source(array(
                        '0' => 'Доступний',
                        '1' => 'Відміненний',
                    )
                ),
                'title' => 'Доступність модуля:',
                'placement' => 'right',
            ));
            ?>
        </td>
    </tr>
    <tr>
        <td>Готовність модуля:</td>
        <td>
            <?php
            $this->widget('editable.EditableField', array(
                'type' => 'select',
                'model' => $moduleRevision->properties,
                'attribute' => 'status',
                'url' => $this->createUrl('moduleRevision/XEditableEditProperties'),
                'source' => Editable::source(array(
                        '0' => 'В розробці',
                        '1' => 'Готовий',
                    )
                ),
                'title' => 'Готовність модуля:',
                'placement' => 'right',
            ));
            ?>
        </td>
    </tr>
    <tr>
        <td>Автор:</td>
        <td><?=StudentReg::getUserNamePayment($moduleRevision->properties->id_user_created).' (id='.$moduleRevision->properties->id_user_created.')'?></td>
    </tr>
</table>
