<?php
/**
 * @var $data Graduate
 */
?>
<div class="GraduatesBlock">
    <table>
        <tr>
            <td style="vertical-align: top;">
                <img src="<?php echo StaticFilesHelper::createPath('image', 'graduates', $data['avatar']); ?>">
            </td>
            <td style="padding-left: 10px;">
                <div class="text">
                    <?php echo Yii::t('graduates', '0320')?>
                    <span><?php $explodingDate = explode("-", $data->graduate_date); echo $explodingDate[2].' ' //variable explodingDate is using for separating month because localization used for month only
                            .Yii::t('month', '0'.($explodingDate[1]+816)) //'816' is const which using for access to message ID in DB with translates examples, where january is 817, etc.
                            .' '.$explodingDate[0]; ?></span>
                </div>
                <div class="text1"><?php echo $data->name(); ?></div>
                <?php if(!empty($data->recall)){?>
                <div class="spoiler-title closed"> <?php echo $b = Yii::t('graduates', '0424'), '&#9660'; ?> </div>
                <div class="spoiler-body">
                    <form name=form_recall>
                        <input type=hidden name=id1 id="id1" value="<?php echo htmlspecialchars($a = Yii::t('graduates', '0423')); ?>">
                        <input type=hidden name=id2 id="id2" value="<?php echo htmlspecialchars($b); ?>">
                    </form>
                    <img onclick="hideRecall(this)" src="<?php echo StaticFilesHelper::createPath('image', 'graduates', "recall.png"); ?>">
                    <?php echo $data->recall; ?>
                </div>
                <?php }?>

                <div class="text">
                    <div>
                        <?php if(!empty($data->position)){
                            echo Yii::t('graduates', '0316') ?>
                            <span><?php echo $data->position; ?></span>
                        <?php } ?>
                    </div>
                    <div>
                        <?php if(!empty($data->position)){
                            echo Yii::t('graduates', '0317') ?>
                            <a href="<?php echo $data->work_site; ?>"
                               target="_blank"> <?php echo $data->work_place; ?> </a>
                        <?php } ?>
                    </div>
                    <div>
                        <?php if(!empty($data->courses_page)){ echo Yii::t('graduates', '0318'); ?>
                        <a href="<?php echo Yii::app()->createUrl('course/index', array('id' => $data->courses_page)); ?>"
                           target="_blank"> <?php echo Course::getCourseName($data->courses_page); ?></a>
                        <?php }?>
                    </div>
                </div>
                <?php echo $this->renderPartial('_educateHistory', array('data' => $data)); ?>
            </td>
        </tr>
    </table>
</div>