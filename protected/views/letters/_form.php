<?php
/* @var $this LettersController */
/* @var $model Letters */
/* @var $form CActiveForm */
?>
<?php
$models = StudentReg::model()->findAll(
array('condition'=>'role<>0 and id<>'.Yii::app()->user->getId(), 'order' => 'id'));

// format models as $key=>$value with listData
$list = CHtml::listData($models,
'id', 'email');
?>
<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'letters-form',
    'action'=> Yii::app()->createUrl('letters/sendletter'),
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
    'enableClientValidation'=>true,
    'enableAjaxValidation'=>true,
    'clientOptions'=>array('validateOnSubmit'=>true,'validateOnChange'=>true),
)); ?>

	<div class="row">
		<?php echo $form->hiddenField($model,'sender_id',array('value'=>Yii::app()->user->getId())); ?>
	</div>

	<div class="letterrow">
        <?php echo $form->label($model,'addressee_id'); ?>
        <?php echo $form->dropDownList($model, 'addressee_id',
            $list,
            array('empty' => Yii::t("letter", "0526")));?>
        <?php echo $form->error($model,'addressee_id'); ?>
	</div>

    <div class="letterrow">
        <?php echo $form->label($model,'theme'); ?>
        <?php echo $form->textField($model,'theme', array('maxlength'=>80)); ?>
        <?php echo $form->error($model,'theme'); ?>
    </div>

	<div class="letterrow">
		<?php echo $form->label($model,'text_letter'); ?>
		<?php echo $form->textArea($model,'text_letter',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'text_letter'); ?>
	</div>
    <div id="flashinfo">
        <?php if(Yii::app()->user->hasFlash('sendletter')):
            echo Yii::app()->user->getFlash('sendletter');
        endif; ?>
    </div>
	<div class="row buttons">
        <?php echo CHtml::submitButton(Yii::t("letter", "0541"), array('class' => "sendletter", 'onclick'=>'{hideFlash()}')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
<script src="<?php echo Config::getBaseUrl(); ?>/scripts/hideFlash.js"></script>