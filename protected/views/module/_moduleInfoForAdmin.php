<?php
/* @var $post Module*/
?>
<script src="<?php echo StaticFilesHelper::fullPathTo('js', 'fileValidation.js');?>"></script>
<div class="moduleTitle">
    <h1>
        <?php echo $post->getTitle(); ?>
    </h1>
<!--    <h1>-->
<!--        --><?php
//        $this->widget('editable.EditableField', array(
//            'type' => 'text',
//            'model' => $post,
//            'attribute' => $post->titleParam(),
//            'url' => $this->createUrl('module/updateModuleAttribute'),
//            'title' => Yii::t('module', '0369'),
//            'placement' => 'right',
//        ));
//        ?>
<!--    </h1>-->
</div>
<div class="moduleInfoTable">
    <div class="moduleInfoTd moduleLogo">
        <img class="moduleImg"
             src="<?php echo StaticFilesHelper::createPath('image', 'module', $post->module_img); ?>"/>
        <div class="imageUpdateForm">
            <?php $form = $this->beginWidget('CActiveForm', array(
                'id' => 'moduleImage-form',
                'action' => Yii::app()->createUrl('module/updateModuleImage', array('id' => $post->module_ID)),
                'htmlOptions' => array(
                    'class' => 'formatted-form',
                    'enctype' => 'multipart/form-data',
                ),
                'enableAjaxValidation' => false,
            )); ?>
            <div class="fileform">
                <div class="hideInput">
                    <?php echo $form->fileField($post, 'module_img', array('tabindex' => '-1', 'id' => 'logoModule', 'onChange' => 'js:getImgName(this.value);CheckFile(this)')); ?>
                </div>
                <div>
                    <?php echo $form->error($post, 'module_img'); ?>
                    <label id="logo" for="logoModule" >
                        <?php echo 'Вибрати'; ?>
                    </label>
                </div>
            </div>
            <div id="errorMessage"></div>
            <div id="avatarInfo"><?php echo 'Не вибрано'; ?></div>
            <div class="row buttons">
                <?php echo CHtml::submitButton($post->isNewRecord ? Yii::t('coursemanage', '0398') : Yii::t('coursemanage', '0399'), array('id'=>'imgButton')); ?>
            </div>
            <?php $this->endWidget(); ?>
        </div>
    </div>
    <div class="moduleInfoTd moduleParam">
        <div>
            <span id="titleModule"><?php echo Yii::t('module', '0214'); ?></span>
            <?php
            $level = $post->level();
            $rate = $post->rate();
            if (isset($level)) echo $level;
            ?>
<!--                --><?php
//                $lg = Yii::app()->session['lg'];
//                $level = $post->level();
//                $rate = $post->level0->id;
//                $sources = Level::allTitlesByLang($lg);
//                $this->widget('editable.EditableField', array(
//                    'type' => 'select',
//                    'model' => $post,
//                    'attribute' => 'level',
//                    'url' => $this->createUrl('module/updateModuleAttribute'),
//                    'source' => Editable::source(array(
//                            '1' => $sources[1],
//                            '2' => $sources[2],
//                            '3' => $sources[3],
//                            '4' => $sources[4],
//                            '5' => $sources[5]
//                        )
//                    ),
//                    'placement' => 'right',
//                ));
//                ?>
            <div class="ratico">
                <?php
                for ($i = 0; $i < $rate; $i++) {
                    ?><span>
                    <img src="<?php echo StaticFilesHelper::createPath('image', 'common', 'ratIco1.png'); ?>"/>
                    </span><?php
                }
                for ($i = $rate; $i < 5; $i++) {
                    ?><span>
                    <img src="<?php echo StaticFilesHelper::createPath('image', 'common', 'ratIco0.png'); ?>"/>
                    </span><?php
                }
                ?>
            </div>
        </div>
        <div>
            <span id="titleModule"><?php echo Yii::t('module', '0215'); ?></span>
            <b> <?php echo $post->getLecturesCount() . " " . Yii::t('module', '0216'); ?></b><?php
            if ($post->getLecturesCount() != 0) {?>
                <?=", " . Yii::t('module', '0217')?> - <b><?=$post->monthsCount() . " " . Yii::t('module', '0218');?></b> (
                <?=$post->hours_in_day . " " . Yii::t('module', '0219') . ", " . $post->days_in_week . " " .
                Yii::t('module', '0220') . ")";
            }
            ?>
        </div>
<!--            <div>-->
<!--                <span id="titleModule">--><?php //echo Yii::t('module', '0215'); ?><!--</span>-->
<!--                <b> --><?php //echo $post->getLecturesCount() . " " . Yii::t('module', '0216'); ?><!--</b>-->
<!--                --><?php
//                if ($post->lecturesCount() !== '0') {
//                    echo ", " . Yii::t('module', '0217') . " - <b>" . $post->monthsCount(). " " . Yii::t('module', '0218') . "</b> (";
//                    $this->widget('editable.EditableField', array(
//                        'type' => 'text',
//                        'model' => $post,
//                        'attribute' => 'hours_in_day',
//                        'url' => $this->createUrl('module/updateModuleAttribute'),
//                        'title' => Yii::t('module', '0370'),
//                        'placement' => 'right',
//                    ));
//                    echo " " . Yii::t('module', '0219') . ", ";
//                    $this->widget('editable.EditableField', array(
//                        'type' => 'text',
//                        'model' => $post,
//                        'attribute' => 'days_in_week',
//                        'url' => $this->createUrl('module/updateModuleAttribute'),
//                        'title' => Yii::t('module', '0371'),
//                        'placement' => 'right',
//                    ));
//                    echo " " . Yii::t('module', '0220') . ")";
//                }
//                ?>
<!--            </div>-->
        <?php if(Yii::app()->user->model->hasOrganizationById($post->id_organization)) { ?>
        <div>
            <span id="titleModule">
                <?php echo Yii::t('courses', '0094'); ?>:
            </span>
            <?php
            $lg = Yii::app()->session['lg'];
            $status = $post->status_online;
            $this->widget('editable.EditableField', array(
                'type' => 'select',
                'model' => $post,
                'attribute' => 'status_online',
                'url' => $this->createUrl('module/updateModuleAttribute'),
                'source' => Editable::source(array(
                        '0' => Yii::t('courses', '0230'),
                        '1' => Yii::t('courses', '0231'),
                    )
                ),
                'title' => Yii::t('courses', '0094').':',
                'placement' => 'right',
            ));
            ?>
        </div>
        <div>
            <span id="titleModule">
                <?php echo Yii::t('courses', '0944'); ?>:
            </span>
            <?php
            $lg = Yii::app()->session['lg'];
            $status = $post->status_offline;
            $this->widget('editable.EditableField', array(
                'type' => 'select',
                'model' => $post,
                'attribute' => 'status_offline',
                'url' => $this->createUrl('module/updateModuleAttribute'),
                'source' => Editable::source(array(
                        '0' => Yii::t('courses', '0230'),
                        '1' => Yii::t('courses', '0231'),
                    )
                ),
                'title' => Yii::t('courses', '0944').':',
                'placement' => 'right',
            ));
            ?>
        </div>
        <?php } else {?>
            <div>
            <span id="titleModule">
                <?php echo Yii::t('courses', '0094'); ?>:
            </span>
                <?php if ($post->status_online == Module::DEVELOP) { ?>
                    <img src="<?php echo StaticFilesHelper::createPath('image', 'courses', 'disabled.png'); ?>">
                    <?php echo Yii::t('courses', '0230');
                } else { ?>
                    <img src="<?php echo StaticFilesHelper::createPath('image', 'courses', 'enable.png'); ?>">
                    <?php echo Yii::t('courses', '0231');
                }
                ?>
            </div>
            <div>
            <span id="titleModule">
                <?php echo Yii::t('courses', '0944'); ?>:
            </span>
                <?php if ($post->status_offline == Module::DEVELOP) { ?>
                    <img src="<?php echo StaticFilesHelper::createPath('image', 'courses', 'disabled.png'); ?>">
                    <?php echo Yii::t('courses', '0230');
                } else { ?>
                    <img src="<?php echo StaticFilesHelper::createPath('image', 'courses', 'enable.png'); ?>">
                    <?php echo Yii::t('courses', '0231');
                }
                ?>
            </div>
        <?php } ?>
        <div>
            <?php $this->renderPartial('_price', array('model'=>$post)); ?>
        </div>
        <br>

        <div class="moduleRating">
            <span id="titleModule"><?php echo Yii::t('module', '0224'); ?></span>
            <?php echo CommonHelper::getRating($post->getAverageRating()); ?>
        </div>
    </div>
</div>