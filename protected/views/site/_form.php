<?php
    $model=new StudentReg();
    $mainpage = new Mainpage();
?>

<script src="//ulogin.ru/js/ulogin.js"></script>

<!-- checkbox validation -->
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/scripts/checkValid.js"></script>
<!-- checkbox validation -->
<link type="text/css" rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/css/regform.css" />
<div style="position:relative;"><a name="form" style="position:absolute; top:-60px;"></a></div>
<div class="regFormBG" >
	<div class="regFormBox">

		<p class="zagolovok"><?php echo Yii::t('regform','0009'); ?></p>
		<p class="zagolovok2"><?php echo Yii::t('regform','0010'); ?></p>

		<div class="signInForm">
			<?php $form=$this->beginWidget('CActiveForm', array(
				'id'=>'studentreg-form',
                'action' => array('site/rapidreg'),
				// Please note: When you enable ajax validation, make sure the corresponding
				// controller action is handling ajax validation correctly.
				// There is a call to performAjaxValidation() commented in generated controller code.
				// See class documentation of CActiveForm for details on this.
                'enableClientValidation'=>true,
                'enableAjaxValidation'=>true,
                'clientOptions'=>array('validateOnSubmit'=>true,'validateOnChange'=>true),
            )); ?>
			<div class="rowemail">
				<?php $placeHolderEmail = Yii::t('regform','0014');?>
				<?php echo $form->textField($model,'email',array('class'=>'signInEmail','placeholder'=>$placeHolderEmail,'size'=>60,'maxlength'=>255)); ?>
				<?php echo $form->error($model,'email',array('id'=>'emailErr')); ?>
			</div>

			<div class="rowpass">
				<?php $placeHolderPassword = Yii::t('regform','0015');?>
				<span class="passEye"> <?php echo $form->passwordField($model,'password',array('class'=>'signInPass','placeholder'=>$placeHolderPassword,'size'=>60,'maxlength'=>255)); ?></span>
				<?php echo $form->error($model,'password',array('id'=>'passErr')); ?>
                <div class="forminfo">
                    <?php if(Yii::app()->user->hasFlash('forminfo')):
                        echo Yii::app()->user->getFlash('forminfo');
                    endif; ?>
                </div>
			</div>

            <div class="regCheckboxW">
                <div class="regCheckbox">
                    <input type="checkbox" id="regCheckbox" value="" name="isExtended" onchange="extReg()"/>
                    <label for="regCheckbox"><?php echo Yii::t('regform','0011'); ?></label>
                </div>
            </div>

			<div class="rowButtons">
				<?php $labelButton = $mainpage->getButtonStart();?>
				<?php echo CHtml::submitButton($labelButton, array('id' => "signInButton")); ?>
			</div>

			<div class="linesignInForm"><?php echo $mainpage->getSocialText(); ?></div>
			<div class="image" >
                    <script src="//ulogin.ru/js/ulogin.js"></script>
                    <div id="uReg" x-ulogin-params="display=buttons;fields=email;optional=first_name,last_name,nickname,bdate,phone,photo,city;
								redirect_uri=<?php echo Yii::app()->request->baseUrl.'/site/socialreg'?>">
							<ul id="uLoginImages">
								<li><img src="<?php echo Yii::app()->request->baseUrl; ?>/css/images/iconsSingin/facebook2.png" x-ulogin-button = "facebook" title = "Facebook"/></li>
                                <li><img src="<?php echo Yii::app()->request->baseUrl; ?>/css/images/iconsSingin/googleplus2.png" x-ulogin-button = "googleplus" title = "Google +"/></li>
                                <li><img src="<?php echo Yii::app()->request->baseUrl; ?>/css/images/iconsSingin/linkedin2.png" x-ulogin-button = "linkedin" title = "LinkedIn"/></li>
                                <li><img src="<?php echo Yii::app()->request->baseUrl; ?>/css/images/iconsSingin/vkontakte2.png" x-ulogin-button = "vkontakte" title = "Вконтакте"/></li>
								<li><img src="<?php echo Yii::app()->request->baseUrl; ?>/css/images/iconsSingin/twitter2.png" x-ulogin-button = "twitter" title = "Twitter"/></li>
							</ul>
					</div>
			</div>

			<?php $this->endWidget(); ?>
		</div><!-- form -->
	</div>
</div>