<?php
/**
 * @var $model Course
 * @var $param string
 */
?>
<ul>
    <a name="<?=$param?>"></a>
    <?php if ($model->$param != '') { ?>
        <p class="subCourseInfo"><b><?php echo Yii::t('course', '0204'); ?></b></p>
        <?php
        $forWhomArray = explode(";", $model->$param);
        ?>
        <li class="<?=$param?>Item"><?= substr($forWhomArray[0], 0, 100); ?>
            <a href="#"  onclick="showBlock('#<?=$param?>Block', '#<?=$param?>Item');">детальніше...</a></li>
        <div id="<?=$param?>Block" style="display: none">
            <?php
            foreach ($forWhomArray as $key => $item) {
                ?>
                <li><?php echo $item . ";"; ?></li>
                <?php
            }
            ?>
            <br>
            <a class="linkDetail" href="#" onclick="hideBlock('#<?=$param?>Block', '#<?=$param?>Item');">приховати</a>
        </div>
    <?php } ?>
</ul>