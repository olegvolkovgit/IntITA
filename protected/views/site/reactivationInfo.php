<?php
if (!Yii::app()->user->isGuest) $this->redirect(Yii::app()->createUrl('/site/index'));
$this->breadcrumbs = array(Yii::t('activeemail', '0303'));
?>
<div class='infoblock'>
    <?php echo Yii::t('activeemail', '0307') . ' ' . $email . ' ' . 'було повторно відправлено листа з інструкціями щодо активації облікового запису. Після отримання листа по електронній пошті, ви ПОВИННІ відвідати URL, вказаний у листі, щоб активувати ваш аккаунт.' ?>
</div>