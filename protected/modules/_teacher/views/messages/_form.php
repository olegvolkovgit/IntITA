<?php
/* @var $this MessagesController */
/* @var $model UserMessages */
/* @var $form CActiveForm */
/* @var $user StudentReg*/
?>
<?php
$models = StudentReg::userLetterReceivers();

$list = CHtml::listData($models,'id', 'email');
?>
<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'user-messages-form',
    'action'=> Yii::app()->createUrl('/_teacher/messages/send'),
    'enableClientValidation'=>true,
    'enableAjaxValidation'=>true,
    'clientOptions'=>array('validateOnSubmit'=>true,'validateOnChange'=>true),
)); ?>

	<div class="row">
		<?php echo $form->hiddenField($model,'sender_id',array('value'=>$user->id)); ?>
	</div>

	<div class="letterrow">

	</div>

    <div class="letterrow">
        <?php echo $form->label($model,'topic'); ?>
        <?php echo $form->textField($model,'topic', array('maxlength'=>80)); ?>
        <?php echo $form->error($model,'topic'); ?>
    </div>

	<div class="letterrow">
		<?php echo $form->label($model,'subject'); ?>
		<?php echo $form->textArea($model,'subject',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'subject'); ?>
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
<script src="<?php echo StaticFilesHelper::fullPathTo('js', 'hideFlash.js'); ?>"></script>