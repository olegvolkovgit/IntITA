<?php
if (!Yii::app()->user->isGuest) $this->redirect(Yii::app()->createUrl('/site/index'));
$this->breadcrumbs = array(Yii::t('activeemail', '0303'));
?>
<div class='infoblock'>
    <?php echo 'На електронну пошту' . ' ' . $email . ' ' . 'було відправлено листа, для приєднання до неї соціальної мережі '.$network ?>
</div>