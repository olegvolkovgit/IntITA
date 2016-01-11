<?php
    $model=new StudentReg();
?>

<a name="form" ></a>
<div class="regFormBG" >
	<div class="regFormBox">
		<p class="zagolovok"><?php echo Yii::t('regform','0009'); ?></p>
		<p class="zagolovok2"><?php echo Yii::t('regform','0010'); ?></p>
		<?php echo $this->decodeWidgets('{{w:AuthorizationFormWidget|dialog=false;id=authForm;authMode=signUp}}'); ?>
	</div>
</div>

<script src="//ulogin.ru/js/ulogin.js"></script>

