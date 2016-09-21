<?php /* @var $this Controller */ ?>
<?php $this->beginContent('//layouts/main'); ?>

<div id="content" class="<?php if (Yii::app()->controller->id == 'site' && Yii::app()->controller->action->id == 'index') echo 'mainPage' ?>">
	
	<?php echo $content;?>

</div><!-- content -->

<?php $this->endContent(); ?>