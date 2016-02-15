<?php

if(!Yii::app()->user->isGuest) $this->redirect(Yii::app()->createUrl('/site/index'));
$this->breadcrumbs=array(Yii::t('activeemail','0303'));

?>
<div class='infoblock'>
    <?php echo 'Ти успішно приєднав електронну пошту' . ' ' . $email . ' ' . 'до соціальної мережі '.$network.' Тепер можеш увійти в свій обліковий запис через соціальну мережу.' ?>
</div>
