<?php
/**
 * Created by PhpStorm.
 * User: Wizlight
 * Date: 06.09.2015
 * Time: 16:09
 */
?>
<img id="arrowCursor" src="<?php echo StaticFilesHelper::createPath('image', 'common', 'arrow.png') ?>">
<img id="pointer" src="<?php echo StaticFilesHelper::createPath('image', 'common', 'pointer.png') ?>">
    <div class="progress">
        <?php
        for ($i = 0, $count = 5; $i < $count; $i++) {
                ?>
                <a class="pageDone pageTitle"
                   href="<?php echo Yii::app()->createURL('lesson/editPage', array('pageId' => $i+1, 'idCourse' => $idCourse));?>"
                   title="<?php echo Yii::t('lecture', '0615')." ".($i+1). '. '; ?>"></a>
            <?php }

?>
    </div>

