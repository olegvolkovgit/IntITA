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
                    <span><?php echo CLocale::getInstance($lang)->dateFormatter->formatDateTime($data->graduate_date,'medium',null); ?></span>
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
                        <?php if(!empty($data->work_place)) {
                            echo Yii::t('graduates', '0317');
                            if (!empty($data->work_site)) {
                                ?>
                                <a href="<?php echo $data->work_site; ?>"
                                   target="_blank"> <?php echo $data->work_place; ?> </a>
                            <?php } else {
                                echo "<span> ".$data->work_place."</span>";
                            }
                        }
                        ?>
                    </div>
                    <div>
                        <?php if(!empty($data->courses_page)){ echo Yii::t('graduates', '0318'); ?>
                        <a href="<?php echo Yii::app()->createUrl('course/index', array('id' => $data->courses_page)); ?>"
                           target="_blank"> <?php echo $data->course->getTitle(); ?></a>
                        <?php }?>
                    </div>
                </div>
                <?php echo $this->renderPartial('_educateHistory', array('data' => $data)); ?>
            </td>
        </tr>
    </table>
</div>