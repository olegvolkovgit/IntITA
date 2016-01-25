<?php
/* @var $model Teacher */
?>
    <br>
    <br>
        <a href="<?php echo Yii::app()->createUrl('/_admin/tmanage/index'); ?>" >Викладачі</a>

    <div class="page-header">
        <h2>Додати викладача</h2>
    </div>
<?php $this->renderPartial('_form', array('model' => $model, 'scenario' => 'create')); ?>