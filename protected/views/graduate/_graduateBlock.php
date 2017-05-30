<?php
/**
 * @var $data Graduate
 */
?>
<div class="GraduatesBlock">
    <div class="graduatesTable">
        <div class="graduatesTd graduateAvatar">
            <img src="<?php echo StaticFilesHelper::createPath('image', 'graduates', $data->user['avatar']); ?>">
            <div class="graduateHeaderMini">
                <div class="text">
                    <?php echo Yii::t('graduates', '0320')?>
                    <span><?php echo CLocale::getInstance($lang)->dateFormatter->formatDateTime($data->rate['date_done'],'medium',null); ?></span>
                </div>
                <div class="text1"><?php echo $data->user['firstName'].' '.$data->user['secondName']; ?></div>
            </div>
        </div>
        <div class="graduatesTd graduateInfo">
            <div class="text graduateDate">
                <?php echo Yii::t('graduates', '0320')?>
                <span><?php echo CLocale::getInstance($lang)->dateFormatter->formatDateTime($data->rate['date_done'],'medium',null); ?></span>
            </div>
            <div class="text1 graduateName"><?php echo $data->user['firstName'].' '.$data->user['secondName']; ?></div>
            <?php if(!empty($data->recall)){?>
            <div class="spoiler-title" onclick="openComment(this)">
                <span><?php echo $b = Yii::t('graduates', '0424'), '&#9660'; ?></span>
                <div class="spoiler-body">
                    <form name=form_recall>
                        <input type=hidden name="maximize" class="maximize" value="<?php echo htmlspecialchars($a = Yii::t('graduates', '0423')); ?>">
                        <input type=hidden name="minimize" class="minimize" value="<?php echo htmlspecialchars($b); ?>">
                    </form>
                    <img onclick="hideRecall(this)" src="<?php echo StaticFilesHelper::createPath('image', 'graduates', "recall.png"); ?>">
                    <?php echo $data->recall; ?>
                </div>
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

                <div class="diploma_link_style">
                    <div>
                        <?php echo Yii::t('graduates', '0318'); ?>
                    </div>
                    <div>
                        <a href="<?php echo Yii::app()->createUrl('course/index', array('id' => $data->rate['id_course'])); ?>"
                       target="_blank"> <?php echo $data->course->getTitle(); ?></a>
                        <a href="#openModal" onclick="diploma_dialog('<?php echo $data->first_name_en.' '.' '.$data->last_name_en?>',
                                                                        '<?php echo $data->course->title_en?>')">Диплом</a>
                    </div>
                </div>
            </div>
            <?php echo $this->renderPartial('_educateHistory', array('data' => $data)); ?>
        </div>
    </div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.2/jspdf.debug.js"></script>