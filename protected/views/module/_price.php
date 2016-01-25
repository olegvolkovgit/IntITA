<?php
if ($price == 0) {
    ?>
    <span class="colorGreen"><?= Yii::t('module', '0421') ?></span>
<?php
} else {
    if ($idCourse > 0) { ?>
        <span
            id="oldPrice"><?= ($price * Config::getCoeffIndependentModule()) . ' ' . Yii::t('module', '0222') ?></span>
        <?= $price . Yii::t('module', '0222') ?>(<?= Yii::t('module', '0223') ?>)
        <?php
    } else { ?>
        <span><?= $price . ' ' . Yii::t('module', '0222') ?></span>
    <?php }
}?>