<?php if($price==0){ ?>
    <span  class="colorGreen"><?= Yii::t('module', '0421') ?></span>
<?php } else {?>
    <span><?php echo $price?><?= Yii::t('module', '0222') ?></span>
<?php } ?>