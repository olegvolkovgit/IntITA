
<div style="text-align: center">Довідники</div>
<div style="text-align: center">
    <div><?php echo CHtml::link("Index",  Yii::app()->createUrl('accountancy/index')); ?></div>
    <div><?php echo CHtml::link("Джерела коштів",  Yii::app()->createUrl('externalSources/index')); ?></div>
</div>
<hr/>
<div style="text-align: center">Операції</div>
<div style="text-align: center">
    <?php echo CHtml::link("Прийом оплат",  Yii::app()->createUrl('externalPays/index')); ?>
</div>
<div style="text-align: center">
    <?php echo CHtml::link("Оплата курсу",  Yii::app()->createUrl('coursePays/index')); ?>
</div>
<div style="text-align: center">
    <?php echo CHtml::link("Оплата модуля",  Yii::app()->createUrl('modulePays/index')); ?>
</div>