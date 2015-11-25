<?php
/**
 * Created by PhpStorm.
 * User: Wizlight
 * Date: 05.06.2015
 * Time: 10:10
 */
?>
<div class="moduleTitle">
    <h1>
        <?php
        $title = ModuleHelper::getModuleTitleParam();
        $this->widget('editable.EditableField', array(
            'type'      => 'text',
            'model'     => $post,
            'attribute' => $title,
            'url'       => $this->createUrl('module/updateModuleAttribute'),
            'title'     => Yii::t('module', '0369'),
            'placement' => 'right',
        ));
        ?>
    </h1>
</div>
<table>
    <tr>
        <td>
<!--            --><?php //var_dump($post);die; ?>
            <img class="moduleImg" src="<?php echo StaticFilesHelper::createPath('image', 'module', $post->module_img);?>" />
            <div class="imageUpdateForm">
                <?php $form=$this->beginWidget('CActiveForm', array(
                    'id'=>'moduleImage-form',
                    'action'=> Yii::app()->createUrl('module/updateModuleImage', array('id'=>$post->module_ID)),
                    'htmlOptions'=>array(
                        'class'=>'formatted-form',
                        'enctype'=>'multipart/form-data',
                    ),
                    'enableAjaxValidation'=>false,
                )); ?>
                <div class="hideInput">
                    <?php echo $form->fileField($post, 'module_img',array('id'=>'logoModule', 'onChange'=>'js:getImgName(this.value)')); ?>
                </div>
                <div>
                    <?php echo $form->error($post,'module_img'); ?>
                    <a onclick="selectLogo()">
                        <?php echo 'Вибрати';?>
                    </a>
                </div>
                <div id="avatarInfo"><?php echo 'Не вибрано';?></div>
                <div class="row buttons">
                    <?php echo CHtml::submitButton($post->isNewRecord ? Yii::t('coursemanage', '0398') : Yii::t('coursemanage', '0399')); ?>
                </div>
                <?php $this->endWidget(); ?>
            </div><!-- form -->
        </td>
        <td style="padding-left: 15px; border-left: 1px solid #cccccc;">
            <div>
                <span id="titleModule"><?php echo Yii::t('module', '0214'); ?></span>
                <?php
                $rate = 0;
                switch ($post->level){
                    case 'intern':
                        $level=Yii::t('courses', '0232');
                        $rate = 1;
                        break;
                    case 'junior':
                        $level=Yii::t('courses', '0233');
                        $rate = 2;
                        break;
                    case 'strong junior':
                        $level=Yii::t('courses', '0234');
                        $rate = 3;
                        break;
                    case 'middle':
                        $level=Yii::t('courses', '0235');
                        $rate = 4;
                        break;
                    case 'senior':
                        $level=Yii::t('courses', '0236');
                        $rate = 5;
                        break;
                }
                $this->widget('editable.EditableField', array(
                    'type'      => 'select',
                    'model'     => $post,
                    'attribute' => 'level',
                    'url'       => $this->createUrl('module/updateModuleAttribute'),
                    'source'    => Editable::source(array('intern'=> Yii::t('courses', '0232'), 'junior' => Yii::t('courses', '0233'),'strong junior' => Yii::t('courses', '0234'), 'middle' => Yii::t('courses', '0235'), 'senior' => Yii::t('courses', '0236'))),
                    'placement' => 'right',
                ));
                ?>
                <div class="ratico">
                    <?php
                    for ($i=0; $i<$rate; $i++)
                    {
                        ?><span>
                        <img src="<?php echo StaticFilesHelper::createPath('image', 'common', 'ratIco1.png'); ?>"/>
                        </span><?php
                    }
                    for ($i=$rate; $i<5; $i++)
                    {
                        ?><span>
                        <img src="<?php echo StaticFilesHelper::createPath('image', 'common', 'ratIco0.png'); ?>"/>
                        </span><?php
                    }
                    ?>
                </div>
            </div>
            <div>
                <span id="titleModule"><?php echo Yii::t('module', '0215'); ?></span>
                <b> <?php echo $post->lesson_count." ".Yii::t('module', '0216'); ?></b>
                <?php
                if($post->lesson_count!=='0'){
                    echo  ", ".Yii::t('module', '0217')." - <b>".round($post->lesson_count*7/($post->hours_in_day*$post->days_in_week))." ".Yii::t('module', '0218')."</b> (";
                    $this->widget('editable.EditableField', array(
                        'type'      => 'text',
                        'model'     => $post,
                        'attribute' => 'hours_in_day',
                        'url'       => $this->createUrl('module/updateModuleAttribute'),
                        'title'     => Yii::t('module', '0370'),
                        'placement' => 'right',
                    ));
                    echo " ".Yii::t('module', '0219').", ";
                    $this->widget('editable.EditableField', array(
                        'type'      => 'text',
                        'model'     => $post,
                        'attribute' => 'days_in_week',
                        'url'       => $this->createUrl('module/updateModuleAttribute'),
                        'title'     => Yii::t('module', '0371'),
                        'placement' => 'right',
                    ));
                    echo " ".Yii::t('module', '0220').")";
                }
                ?>
            </div>
            <div>
                <span id="titleModule"><?php echo Yii::t('module', '0221'); ?></span>
                <span>
                    <?php
                    $this->widget('editable.EditableField', array(
                        'type'      => 'text',
                        'model'     => $post,
                        'attribute' => 'module_price',
                        'url'       => $this->createUrl('module/updateModuleAttribute'),
                        'title'     => Yii::t('module', '0372'),
                        'placement' => 'right',
                    ));
                    ?>
                    <?php echo Yii::t('module', '0222'); ?>
                </span>
            </div>
            <br>
            <div class="moduleRating">
                <span id="titleModule"><?php echo Yii::t('module', '0224'); ?></span>
                <?php echo RatingHelper::getRating($post->rating); ?>
            </div>
        </td>
    </tr>
</table>