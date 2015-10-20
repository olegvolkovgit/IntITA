<?php
    $model=new StudentReg();
?>

<a name="form" ></a>
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
                'clientOptions'=>array('validateOnSubmit'=>true,'validateOnChange'=>false),
				'htmlOptions' => array('name'=>'rapidReg','novalidate'=>true),
            )); ?>
			<div class="rowemail">
				<?php $placeHolderEmail = Yii::t('regform','0014');?>
				<?php echo $form->emailField($model,'email',array('class'=>'signInEmail','placeholder'=>$placeHolderEmail,'size'=>60,'maxlength'=>40,'ng-model'=>"email", "ng-required"=> "true && !regChecked", 'onKeyUp'=>"hideServerValidationMes(this)")); ?>
				<?php echo $form->error($model,'email',array('id'=>'emailErr')); ?>
				<div class="clientValidationError" ng-show="rapidReg['StudentReg[email]'].$dirty && rapidReg['StudentReg[email]'].$invalid">
					<span ng-cloak ng-show="rapidReg['StudentReg[email]'].$error.required"><?php echo Yii::t('error','0268') ?></span>
					<span ng-cloak ng-show="rapidReg['StudentReg[email]'].$error.email"><?php echo Yii::t('error','0271') ?></span>
					<span ng-cloak ng-show="rapidReg['StudentReg[email]'].$error.maxlength"><?php echo Yii::t('error','0271') ?></span>
				</div>
			</div>

			<div class="rowpass">
				<?php $placeHolderPassword = Yii::t('regform','0015');?>
				<span class="passEye"> <?php echo $form->passwordField($model,'password',array('class'=>'signInPass','placeholder'=>$placeHolderPassword,'size'=>60,'maxlength'=>20,'ng-model'=>"rapidRegPass", "ng-required"=>"true && !regChecked" )); ?></span>
				<?php echo $form->error($model,'password',array('id'=>'passErr')); ?>
				<div class="clientValidationError" ng-show="rapidReg['StudentReg[password]'].$dirty && rapidReg['StudentReg[password]'].$invalid">
					<span ng-cloak ng-show="rapidReg['StudentReg[password]'].$error.required"><?php echo Yii::t('error','0268') ?></span>
				</div>
			</div>

            <div class="regCheckboxW">
                <div class="regCheckbox">
                    <input type="checkbox" id="regCheckbox" ng-init='regChecked=false' ng-model="regChecked" name="isExtended" />
                    <label for="regCheckbox"><?php echo Yii::t('regform','0011'); ?></label>
                </div>
            </div>
			<div class="rowButtons">
				<?php $labelButton = MainpageHelper::getButtonStart();?>
				<?php echo CHtml::submitButton($labelButton, array('id' => "signInButton", 'ng-disabled'=>'rapidReg["StudentReg[password]"].$dirty && rapidReg.$invalid')); ?>
			</div>

			<div class="linesignInForm"><?php echo MainpageHelper::getSocialText(); ?></div>
			<div class="image" >
                    <div id="uReg" x-ulogin-params="display=buttons;fields=email;optional=first_name,last_name,nickname,bdate,phone,photo,city;
								redirect_uri=<?php echo Config::getBaseUrl().'/site/sociallogin'?>">
							<ul id="uLoginImages">
								<li><img src="<?php echo  StaticFilesHelper::createPath('image', 'signin', 'facebook2.png'); ?>" x-ulogin-button = "facebook" title = "Facebook"/></li>
                                <li><img src="<?php echo  StaticFilesHelper::createPath('image', 'signin', 'googleplus2.png'); ?>" x-ulogin-button = "googleplus" title = "Google +"/></li>
                                <li><img src="<?php echo  StaticFilesHelper::createPath('image', 'signin', 'linkedin2.png'); ?>" x-ulogin-button = "linkedin" title = "LinkedIn"/></li>
                                <li><img src="<?php echo  StaticFilesHelper::createPath('image', 'signin', 'vkontakte2.png'); ?>" x-ulogin-button = "vkontakte" title = "Вконтакте"/></li>
								<li><img src="<?php echo  StaticFilesHelper::createPath('image', 'signin', 'twitter2.png'); ?>" x-ulogin-button = "twitter" title = "Twitter"/></li>
							</ul>
					</div>
			</div>

			<?php $this->endWidget(); ?>
		</div><!-- form -->
	</div>
</div>

<script src="//ulogin.ru/js/ulogin.js"></script>

