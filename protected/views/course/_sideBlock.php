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
        <li id="<?=$param?>Item"><?= (strlen($forWhomArray[0]) <= 60)?$forWhomArray[0]:mb_substr($forWhomArray[0], 0, 60, 'UTF-8')."..."; ?>
            <a href="#" onclick="showBlock('#<?=$param?>Block', '#<?=$param?>Item', '#linkDetail<?=$param?>'); return false;">детальніше...</a></li>
        <div id="<?=$param?>Block" style="display: none">
            <?php
            foreach ($forWhomArray as $key => $item) {
                ?>
                <li><?php echo $item . ";"; ?></li>
                <?php
            }
            ?>
            <a id="linkDetail<?=$param?>" href="#" onclick="hideBlock('#<?=$param?>Block', '#<?=$param?>Item', '#linkDetail<?=$param?>');  return false;">
                приховати
            </a>
        </div>
    <?php } ?>
</ul>