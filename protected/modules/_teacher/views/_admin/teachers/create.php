<?php
/* @var $model Teacher
 * @var $predefinedUser StudentReg
 * @var $message int
 */
?>
<div class="col-md-8">
    <?php if(!$predefinedUser){?>
    <ul class="list-inline">
    <li>
        <button type="button" class="btn btn-primary"
                onclick="load('<?php echo Yii::app()->createUrl('/_teacher/_admin/teachers/index'); ?>',
                    'Співробітники')">Співробітники</button>
    </li>
    </ul>
    <?php } ?>
<?php $this->renderPartial('_form', array(
    'model' => $model,
    'scenario' => 'create',
    'predefinedUser' => $predefinedUser,
    'message' => $message
)); ?>
</div>