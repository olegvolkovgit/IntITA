<?php
/**
 * @var $model Course
 * @var $param string
 */
?>
<ul>
    <a name="<?=$param?>"></a>
    <?php if ($model->$param != '') { ?>
        <p class="subCourseInfo"><b><?=$model->getPropertyLabel($param);?></b></p>
        <?php
        $forWhomArray = explode(";", $model->$param);
        if(strlen($model->$param) < 75){?>
            <?php
            foreach ($forWhomArray as $key => $item) {
                ?>
                <li><?php echo $item . ";"; ?></li>
                <?php
            }
            ?>
        <?php }
        else {
            ?>
            <li id="<?= $param ?>Item"><?= (strlen($forWhomArray[0]) <= 60) ? $forWhomArray[0] : mb_substr($forWhomArray[0], 0, 60, 'UTF-8') . "..."; ?>
                <a class="hideBlockLink" href=""
                   onclick="showBlock('#<?= $param ?>Block', '#<?= $param ?>Item', '#linkDetail<?= $param ?>'); return false;"><?php echo Yii::t('courses', '0146'); ?></a>
            </li>
            <div id="<?= $param ?>Block" class="hideBlock">
                <?php
                foreach ($forWhomArray as $key => $item) {
                    ?>
                    <li><?php echo $item . ";"; ?></li>
                    <?php
                }
                ?>
                <a class="hideBlockLink" id="linkDetail<?= $param ?>" href=""
                   onclick="hideBlock('#<?= $param ?>Block', '#<?= $param ?>Item', '#linkDetail<?= $param ?>');  return false;">
                    <?php echo Yii::t('lecture', '0082'); ?>
                </a>
            </div>
            <?php
        }
    } ?>
</ul>