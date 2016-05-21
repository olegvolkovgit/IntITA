<?php
/**
 * @var $model Module
 * @var $idCourse int
 */
$price = $model->modulePrice($idCourse);
if ($price == 0) {
    ?>
    <span class="colorGreen"><?= Yii::t('module', '0421') ?></span>
<?php
} else {
    if ($idCourse > 0) { ?>
        <span id="oldPrice">
            <?= $model->getIndepedentModulePrice() . ' ' . Yii::t('module', '0222') ?></span>
        <?= $price . Yii::t('module', '0222') ?>(<?= Yii::t('module', '0223') ?>)
        <?php
    } else { ?>
        <span><?= $price . ' ' . Yii::t('module', '0222') ?></span>
    <?php }
}?>