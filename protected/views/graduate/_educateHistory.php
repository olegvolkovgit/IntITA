<div class="lessonBlock" id="lessonBlock">
    <!--    <span class="spoilerLinks"><span class="spoilerClick">Розгорнути історію навчання</span><span class="spoilerTriangle"> &#9660;</span></span>-->
    <!--    <div class="spoilerBody">-->
    <!--        --><?php //echo $this->renderPartial('_moduleHistory', array('moduleTitle' => 'Модуль 1'));?>
    <!--        --><?php //echo $this->renderPartial('_moduleHistory', array('moduleTitle' => 'Модуль 2'));?>
    <!--        --><?php //echo $this->renderPartial('_moduleHistory', array('moduleTitle' => 'Модуль 3'));?>
    <!--        --><?php //echo $this->renderPartial('_moduleHistory', array('moduleTitle' => 'Модуль 4'));?>
    <!--        --><?php //echo $this->renderPartial('_moduleHistory', array('moduleTitle' => 'Модуль 5'));?>
    <!--        --><?php //echo $this->renderPartial('_moduleHistory', array('moduleTitle' => 'Модуль 6'));?>
    <!--    </div>-->
    <div class="rat" style="padding-top: 5px;">
        <?php echo Yii::t('graduates', '0319')?>
        <?php echo CommonHelper::getRating(((double)$data->rate['rating']*Config::getRatingScale())); ?>
    </div>
</div>