<?php
/**
 * @var $data Graduate
 */
?>
<div class="GraduatesBlock">
    <div class="graduatesTable">
        <div class="graduatesTd graduateAvatar">
            <img src="<?php echo StaticFilesHelper::createPath('image', 'graduates', $data['avatar']); ?>">
            <div class="graduateHeaderMini">
                <div class="text">
                    <?php echo Yii::t('graduates', '0320')?>
                    <span><?php echo CLocale::getInstance($lang)->dateFormatter->formatDateTime($data->graduate_date,'medium',null); ?></span>
                </div>
                <div class="text1"><?php echo $data->name(); ?></div>
            </div>
        </div>
        <div class="graduatesTd graduateInfo">
            <div class="text graduateDate">
                <?php echo Yii::t('graduates', '0320')?>
                <span><?php echo CLocale::getInstance($lang)->dateFormatter->formatDateTime($data->graduate_date,'medium',null); ?></span>
            </div>
            <div class="text1 graduateName"><?php echo $data->name(); ?></div>
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

                <div class="diploma_link_style">
                    <div>
                        <?php if(!empty($data->courses_page)){ echo Yii::t('graduates', '0318'); ?>
                    </div>
                    <div>
                        <a href="<?php echo Yii::app()->createUrl('course/index', array('id' => $data->courses_page)); ?>"
                       target="_blank"> <?php echo $data->course->getTitle(); ?></a>
                        <a href="#openModal" onclick="diploma_dialog('<?php echo $data->first_name_en.' '.' '.$data->last_name_en?>',
                                                                        '<?php echo $data->course->title_en?>')">Диплом</a>
                    </div>
<!--                    <div id="openModal" class="modalDialog">-->
<!--                        <div>-->
<!--                            <h2>Модальное окно</h2>-->
<!--                            <p>Пример простого модального окна, которое может быть создано с использованием CSS3.</p>-->
<!--                            <p>Его можно использовать в широком диапазоне, начиная от вывода сообщений и заканчивая формой регистрации.</p>-->
<!--                        </div>-->
<!--                    </div>-->
                    <?php }?>

                </div>
            </div>
            <?php echo $this->renderPartial('_educateHistory', array('data' => $data)); ?>
        </div>
    </div>
</div>